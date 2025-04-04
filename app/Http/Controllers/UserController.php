<?php

namespace App\Http\Controllers;

use App\Mail\RegisterUserMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('auth.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Les informations d\'identification fournies ne correspondent pas à nos dossiers.',
            ])
            ->onlyInput('email');
    }

    /*
     * Afficher la page de Connexion
     */
    public function login()
    {
        return view('auth.login');
    }

    /*
     * Afficher la page d'Inscription
     */
    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:5',
            ],
            [
                'nom.required' => 'Le champ nom est obligatoire.',
                'email.required' => 'Le champ email est obligatoire.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'email.unique' => 'Cette adresse email est déjà utilisée.',
                'password.required' => 'Le champ mot de passe est obligatoire.',
                'password.min' => 'Le mot de passe doit contenir au moins 5 caractères.',
            ],
        );

        $user = new User();
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($request->email)->send(new RegisterUserMail($user));

        return redirect()->route('auth.login')->with('status', 'Votre compte a bien été créé.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
