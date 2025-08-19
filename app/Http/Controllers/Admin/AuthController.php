<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $expectedUser = env('ADMIN_USER', 'admin');
        $expectedPass = env('ADMIN_PASS', 'secret');

        if ($credentials['username'] === $expectedUser && $credentials['password'] === $expectedPass) {
            $request->session()->put('is_admin', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Identifiants invalides'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}


