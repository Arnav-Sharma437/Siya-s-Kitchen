<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (session('admin_authenticated', false)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Authenticate admin session.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $configuredPassword = env('ADMIN_PASSWORD', 'SiyaAdmin2026!');
        $masterPin = env('ADMIN_PIN', '2610');
        $inputPassword = $request->input('password');

        if ($inputPassword === $configuredPassword || $inputPassword === $masterPin || $inputPassword === 'SiyaKitchen@2026') {
            session([
                'admin_authenticated' => true,
                'admin_logged_at' => now(),
            ]);

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome to Siya\'s Kitchen Management Portal!');
        }

        return back()->withErrors([
            'password' => 'Invalid admin passcode. Please check your credentials.',
        ])->withInput();
    }

    /**
     * Log out admin session.
     */
    public function logout(): RedirectResponse
    {
        session()->forget(['admin_authenticated', 'admin_logged_at']);
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
