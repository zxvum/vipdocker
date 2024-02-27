<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreatedMail;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    public function redirectToVKProvider()
    {
        return Socialite::driver('vkontakte')->redirect();
    }
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToDiscordProvider()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Failed to authenticate user');
        }
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_user_id', $socialUser->getId())
            ->first();

        if ($user = \auth()->user()){
            if ($socialAccount){
                return to_route('profile.connections')->with('error', 'Данный аккаунт( '.$provider.' ): '.$socialUser->getName().' уже привязан к другому профилю.');
            }

            SocialAccount::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_user_id' => $socialUser->getId(),
                'nickname' => $socialUser->getNickname(),
            ]);

            return to_route('profile.connections');
        }

        if ($socialAccount) {
            // User is already registered with this social account, log them in
            auth()->login($socialAccount->user);

            return redirect()->route('home');
        }

        // User is not registered with this social account, check if they have an account already
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            Auth::loginUsingId($user->id);

            // Attach social network to existing account
            $socialNetwork = SocialAccount::create([
                'user_id' => $user->id,
                'provider' => ucfirst($provider),
                'provider_user_id' => $socialUser->getId(),
                'nickname' => $socialUser->getNickname()
            ]);

            return redirect('/')->with('success', 'Вы успешно вошли!');
        } else {
            $password = Str::random(16);

            if ($provider == 'discord'){
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make($password),
                ]);
            } else {
                list($firstName, $lastName) = explode(' ', $socialUser->getName(), 2);

                $user = User::create([
                    'name' => $firstName,
                    'surname' => $lastName,
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make($password),
                ]);
            }

            $user->assignRole('user');

            // Send welcome email to the user
            Mail::to($user->email)->send(new AccountCreatedMail($user, $password));
        }

        // Create a social account for the user
        $user->socialAccounts()->create([
            'provider' => $provider,
            'provider_user_id' => $socialUser->getId(),
        ]);

        // Log in the user
        auth()->login($user);

        return redirect()->route('home');
    }

// метод для отвязывания социальной сети от аккаунта пользователя
    public function unlinkSocialAccount(Request $request, $provider)
    {
        // ищем запись в таблице social_accounts для текущего пользователя и провайдера
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('user_id', Auth::id())
            ->first();

        if ($socialAccount) {
            // удаляем запись из таблицы social_accounts
            $socialAccount->delete();
        }

        // перенаправляем пользователя на нужную страницу
        return to_route('profile.connections');
    }

    public function setPassword(){
        return view('auth.set-password');
    }

    public function setPasswordPost(Request $request){
        $request->validate([
            'password' => ['required', 'string', 'min:6']
        ]);

        $user = \auth()->user();
        $user->password = $request->password;
        $user->save();

        return to_route('home');
    }
}
