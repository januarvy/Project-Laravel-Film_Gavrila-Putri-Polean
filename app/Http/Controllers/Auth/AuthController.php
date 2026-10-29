<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'password'   => Hash::make($validated['password']),
            'role_id'    => 1,
            'profile_id' => \App\Models\Profile::create([
                'alamat' => '-',
                'umur'   => 0,
                'bio'    => 'Profile of '.$validated['name'],
            ])->id,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Registrasi berhasil. Selamat datang, '.$user->name.'!');
    }

    /**
     * Show the standalone login page.
     */
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect(auth()->user()->role_id == 2 ? route('admin.dashboard') : route('home'));
        }

        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $redirectTo = Auth::user()->role_id == 2 ? route('admin.dashboard') : route('home');

            return redirect()
                ->intended($redirectTo)
                ->with('success', 'Login berhasil. Selamat datang, '.Auth::user()->name.'!');
        }

        return back()
            ->withErrors(['login' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah keluar.');
    }
}
