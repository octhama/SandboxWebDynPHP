<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLogin(): View|Factory|Application
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = (new User)->where('email', $credentials['email'])->first();

        if ($user && ($user->password === $credentials['password'] || password_verify($credentials['password'], $user->password))) {
            Auth::login($user);
            return redirect()->route('dashboard.welcome')->with('success', 'Bienvenue !');
        }

        return back()->with('error', 'Email ou mot de passe incorrect.');
    }

    public function showSignup(): View|Factory|Application
    {
        return view('auth.signup'); // Retourne la vue d'inscription
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,employee', // Validation du rôle
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Stocke le rôle choisi
        ]);

        return redirect()->route('login')->with('success', 'Compte créé avec succès ! Connectez-vous 🎉');
    }
    // Déconnexion
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}
