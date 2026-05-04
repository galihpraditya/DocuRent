<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except(['logout']);
        $this->middleware('auth')->only(['logout']);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin')->with('success', 'Login berhasil sebagai admin');
            }
            return redirect('/')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'Login gagal');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'
        ]);

        $user = new User($validated);
        $user->password = Hash::make($validated['password']);
        $user->role = 'user';
        $user->save();

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
