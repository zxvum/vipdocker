<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserDocument;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class ProfileController extends Controller
{
    public function accountView()
    {
        return view('profile.account');
    }

    public function accountUpdatePost(Request $request){
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
        ]);

        $user = \auth()->user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();

        return redirect()->back()->with('success', 'Ваш профиль был успешно обновлен.');
    }


    public function securityView()
    {
        return view('profile.security');
    }

    public function billingView()
    {
        return view('profile.billing');
    }
    public function connectionsView()
    {
        return view('profile.connections');
    }
}
