<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        // Jika sudah login langsung ke halaman mata kuliah
        if (Auth::check()) {
            return redirect()->route('subjects');
        }

        return view('login');
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('subjects')
                             ->with('success', 'Login berhasil.');
        }

        return back()
                ->withInput()
                ->with('error', 'Email atau Password salah.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Berhasil logout.');
    }
}
