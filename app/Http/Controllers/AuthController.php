<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function Login(Request $request){
// 1. Validasi: kedua kolom wajib diisi
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Cocokkan dengan tabel users (password dibandingkan dengan hash-nya)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();              // buat ID session baru
            return redirect()->intended(route('home'));     // ke halaman yang tadi dituju, atau home
        }

        // 3. Gagal: balik ke form dengan pesan error
        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }

    public function Logout(Request $request){
        Auth::logout();                                     // hapus status login
        $request->session()->invalidate();                  // hapus seluruh data session
        $request->session()->regenerateToken();             // token CSRF baru
        return redirect()->route('login');
    }
}
