<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        try {
            $user = User::where('email', $request->email)->first();

            if (! $user) {
                return back()->withErrors(['email' => 'Email tidak ditemukan']);
            }

            if (! Hash::check($request->password, $user->password)) {
                return back()->withErrors(['password' => 'Password salah']);
            }

            Auth::login($user);
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->route('dashboard');
            }

        } catch (Exception $e) {

            return back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi']);
        }

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function registrasi(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:10,15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {

            User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'user',
            ]);

            return redirect()->back()->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat registrasi.'.$e->getMessage());
        }
    }
}