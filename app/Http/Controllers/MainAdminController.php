<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staf;

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
            'users' => User::paginate(10),
        ]);
    }

    public function newUser()
    {
        return view('admin.newUser', [
            'title' => 'New User',
            'staf' => Staf::all(),
        ]);
    }

    public function addUser(Request $request)
    {
        $MAX_IMAGE_SIZE = 10240;

        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'id_grup' => 'nullable',
            'id_staf' => 'nullable',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'name' => 'nullable|max:50',
            'phone' => 'nullable',
            'photo' => 'nullable|image|max:'.$MAX_IMAGE_SIZE,
        ], [
            'photo.image' => 'File yang diupload harus berupa gambar!',
            'photo.max' => 'Ukuran gambar tidak boleh lebih dari '.($MAX_IMAGE_SIZE / 1024).'MB'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle profile picture upload
        if ($request->hasFile('photo')) {
            $profilePicture = $request->file('photo');
            $profilePictureName = time() . '_' . $validatedData['username'] . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('storage/profile_pictures/'), $profilePictureName);
            $validatedData['photo'] = 'profile_pictures/' . $profilePictureName;
        }
        
        $user = User::create($validatedData);

        event(new Registered($validatedData));
        $user->sendEmailVerificationNotification();

        return redirect('/admin/user-manager')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function editUser(User $user)
    {
        return view('admin.editUser', [
            'title' => 'Edit User',
            'user' => $user,
            'staf' => Staf::all(),
        ]);
    }

    public function editUserSubmit(Request $request, User $user)
    {
        $MAX_IMAGE_SIZE = 10240;

        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'id_grup' => 'nullable',
            'id_staf' => 'nullable',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'name' => 'nullable|max:50',
            'phone' => 'nullable',
            'photo' => 'nullable|image|max:'.$MAX_IMAGE_SIZE,
        ], [
            'photo.image' => 'File yang diupload harus berupa gambar!',
            'photo.max' => 'Ukuran gambar tidak boleh lebih dari '.($MAX_IMAGE_SIZE / 1024).'MB'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle profile picture upload
        if ($request->hasFile('photo')) {
            $profilePicture = $request->file('photo');
            $profilePictureName = time() . '_' . $validatedData['username'] . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('storage/profile_pictures/'), $profilePictureName);
            $validatedData['photo'] = 'profile_pictures/' . $profilePictureName;
        }

        User::firstWhere('id', $user->id)->update($validatedData);

        return redirect('/admin/user-manager')->with('success', 'Akun berhasil di edit!');
    }

    public function deleteUser(User $user)
    {
        $acc = User::firstWhere('id', $user->id);

        User::destroy($acc->id);

        return redirect('/admin/user-manager')->with('success', 'Akun berhasil di hapus!');
    }
}
