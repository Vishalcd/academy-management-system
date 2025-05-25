<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("auth.login", ['title' => 'Login | Parishkar School Sds | Accounting
        Management System',
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            $user = Auth::user(); // Now authenticated user

            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended(route('home'))->with('success', "You are now logged In!");
                case 'employee':
                    return redirect()->intended(route('employees.showMe'))->with('success', "You are now logged In!");
                case 'student':
                    return redirect()->intended(route('students.showMe'))->with('success', "You are now logged In!");
                default:
                    Auth::logout(); // log out if role is invalid
                    return redirect()->route('login')->withErrors(['email' => 'Unauthorized role.']);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}
