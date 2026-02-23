<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        // If user is authenticated and no success message, redirect to dashboard
        if (Auth::check() && !session('success')) {
            $user = Auth::user();
            if ($user->hasRole('Admin')) {
                return redirect()->route('filament.admin.pages.dashboard');
            } else {
                return redirect(route('dashboard', absolute: false));
            }
        }
        
        return view('auth.register');
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign default role (User)
        $userRole = Role::where('name', 'User')->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }

        event(new Registered($user));

        Auth::login($user);

        // Flash success message and redirect back to registration page to show the message
        return redirect()->route('register')->with('success', 'Registration Successful!');
    }
}
