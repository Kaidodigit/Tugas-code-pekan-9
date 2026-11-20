<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('rak.index'); 
        }

        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('rak.index'))->with('success', 'Berhasil masuk ke sistem gudang!');
        }

        
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }
    
    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar dari sistem.');
    }
    public function showRegister()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $data = $request->validate([
        'username' => 'required|string|max:50|unique:users,username',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'username' => $data['username'],
        'password' => $data['password'], // otomatis di-hash oleh cast 'hashed' di model User
        'role'     => 'staff',           // dikunci, tidak diambil dari input
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
}
}