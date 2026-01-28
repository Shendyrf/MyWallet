<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // menampilkan form login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // set session manual
            session([
                'user_id' => $user->user_id,
                'user_name' => $user->name,
                'user_email' => $user->email
            ]);

            return redirect()->intended('/')->with('success', 'Login berhasil'); 
        }

        return back()->with('loginError', 'Email atau password salah');
    }

    // logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
