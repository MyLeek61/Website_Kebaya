<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    // Menampilkan halaman Register
    public function showRegister()
    {
        return view('register');
    }

    // Memproses Pendaftaran
    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string',
            'role' => 'required|string|in:user,counselor',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        // Langsung otomatis login setelah register
        Auth::login($user);

        return $this->redirectBasedOnRole($user->role);
    }

    // 1. Menampilkan halaman Login
    public function showLogin()
    {
        return view('login');
    }

    // 2. Memproses Login Pengguna
    public function login(Request $request)
    {
        // Validasi input form login
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba autentikasi data ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // PENGALIHAN YANG BENAR:
            // Semua role (counselor maupun user) langsung dialihkan ke rute 'dashboard'
            return redirect()->route('dashboard')
                             ->with('success', 'Selamat datang kembali!');
        }

        // Jika gagal, kembalikan dengan pesan eror
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // 3. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Helper: Mengatur arah redirect berdasarkan role
    private function redirectBasedOnRole($role)
    {
        if ($role === 'counselor') {
            return redirect()->route('dashboard.counselor');
        }
        return redirect()->route('dashboard.user');
    }
}