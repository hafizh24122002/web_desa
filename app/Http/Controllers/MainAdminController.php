<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class MainAdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Home Admin',
        ]);
    }

    public function userManager()
    {
        return view('admin.userManager', [
            'title' => 'User Manager',
            'users' => User::all(),
        ]);
    }

    public function newUser()
    {
        return view('admin.newUser', [
            'title' => 'New User'
        ]);
    }

    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'id_grup' => 'nullable',
            'id_pamong' => 'nullable',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'name' => 'nullable|max:50',
            'phone' => 'nullable'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        
        User::create($validatedData);

        return redirect('/admin/user-manager')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function editUser(User $user)
    {
        return view('admin.editUser', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function editUserSubmit(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'id_grup' => 'nullable',
            'id_pamong' => 'nullable',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'name' => 'nullable|max:50',
            'phone' => 'nullable'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::firstWhere('id', $user->id)->update($validatedData);

        return redirect('/admin/user-manager');
    }

    public function deleteUser(User $user)
    {
        $acc = User::firstWhere('id', $user->id);

        User::destroy($acc->id);

        return redirect('/admin/user-manager');
    }
}
