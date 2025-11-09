<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommentAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $redirectTo = $this->resolveRedirectTarget($request->input('redirect_to', url()->previous()));

        return view('auth.login', [
            'redirectTo' => $redirectTo,
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'redirect_to' => ['nullable', 'string'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $target = $this->resolveRedirectTarget($validated['redirect_to'] ?? null);

            return redirect()->intended($target)->with('success', 'Connexion réussie.');
        }

        return back()
            ->withErrors(['email' => 'Identifiants incorrects.'])
            ->onlyInput('email');
    }

    public function showRegisterForm(Request $request)
    {
        $redirectTo = $this->resolveRedirectTarget($request->input('redirect_to', url()->previous()));

        return view('auth.register', [
            'redirectTo' => $redirectTo,
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'redirect_to' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $target = $this->resolveRedirectTarget($validated['redirect_to'] ?? null);

        return redirect()->intended($target)->with('success', 'Bienvenue sur Buena Salud !');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function resolveRedirectTarget(?string $target): string
    {
        if (empty($target)) {
            return route('home');
        }

        $absoluteHome = url('/');

        if (!str_starts_with($target, $absoluteHome)) {
            return route('home');
        }

        return $target;
    }
}

