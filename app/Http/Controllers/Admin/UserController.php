<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function AllUsers()
    {
        $all_users = User::query()->where('is_delete', false);
        $users = $all_users->get();
        if ($search = \request('search')) {
            $users = $all_users->where('name', 'like', '%'.$search.'%')->orWhere('surname', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%')->get();
        }
        return view('admin.users.table', ['users' => $users]);
    }

    public function EditUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('user_not_found', 'Данный пользователь не найден.');
        }
        $countries = Country::all();
        $roles = Role::all();
        return view('admin.users.edit.index', ['user' => $user, 'countries' => $countries, 'roles' => $roles]);
    }

    public function EditUserPost($id, Request $request)
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'balance' => ['required', 'integer'],
        ]);

        if ($request->email !== $user->email) {
            $request->validate([
                'email' => ['required', 'email', 'unique:users,email'],
            ]);
        }

        if (!$user) {
            return redirect()->back()->with('error', 'Данный пользователь не найден.');
        }

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'balance' => $request->balance,
            'email' => $request->email
        ]);

        return to_route('admin.user.edit', ['id' => $user->id])->with('success', 'Пользователь успешно обновлен!');
    }

    public function AddAddressUser($id)
    {
        $user = User::find($id);
        $countries = Country::all();
        return view('admin.users.edit.add-address', ['user' => $user, 'addresses' => $user->addresses, 'countries' => $countries]);
    }

    public function AddAddressUserPost(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'country' => ['required', 'exists:countries,id'],
            'region' => ['required', 'string'],
            'city' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'street' => ['required', 'string'],
            'phone_number' => ['required'],
            'email' => ['email'],
        ]);

        if ($user = User::find($id)) {
            Address::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'surname' => $request->name,
                'country_id' => $request->country,
                'region' => $request->region,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'street' => $request->street,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);
        }

        return to_route('admin.user.edit', ['id' => $user->id])->with('success', 'Адрес был успешно добавлен!');
    }

    public function createView()
    {
        $roles = Role::all();
        return view('admin.users.create', ['roles' => $roles]);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'balance' => ['integer'],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => $request->balance
        ]);

        $user->assignRole($request->role);

        return to_route('admin.user.all-users')->with('success', 'Пользователь с именем: ' . $request->name . ' ' . $request->surname . ' был успешно создан!');
    }

    public function DeleteAddress($address_id, $user_id){
        $address = Address::find($address_id);
        $address->delete();
        return to_route('admin.user.edit', ['id' => $user_id])->with('danger', 'Адрес был успешно удален!');
    }

    public function DeleteUser($id){
        $user = User::find($id);
        if ($user->update(['is_delete' => true])) {
            return to_route('admin.user.all-users')->with('success', 'Пользователь был успешно удален.');
        }
        return to_route('admin.user.all-users')->with('error', 'Пользователя не удалось удалить.');
    }
}
