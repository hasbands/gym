<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // Adjust this to the correct Blade template path if different
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_whatsapp' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('profil'), $fotoName);
            $fotoPath = 'profil/' . $fotoName;
        }

        // Create the user
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
            'no_whatsapp' => $request->no_whatsapp,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        // Redirect to a login page or dashboard with a success message
        Alert::success('Berhasil terdaftar, silahkan masuk!');
        return redirect()->route('login');
    }
}