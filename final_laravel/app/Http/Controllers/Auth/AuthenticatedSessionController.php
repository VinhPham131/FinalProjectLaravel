<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $currentPath = request()->header('Referer');
        return redirect()->to($currentPath);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $currentPath = request()->header('Referer');

        // Preserve the remembered email before logging out
        $rememberedEmail = session('remembered_email');

        // Log out the user
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Restore the remembered email from session before redirecting
        if ($rememberedEmail) {
            session(['remembered_email' => $rememberedEmail]);
        }

        // return redirect('/');
        return redirect()->to($currentPath);
    }
}
