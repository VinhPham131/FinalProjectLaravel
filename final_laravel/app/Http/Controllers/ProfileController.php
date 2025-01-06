<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('account', [
            'user' => $request->user(),
            'activeTab' => 'account', // Ensure 'account' tab is active
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null; // Reset email verification if email changes
        }

        $user->save();

        return Redirect::route('user.account.tab', ['tab' => 'account'])
            ->with('status', 'profile-updated'); // Flash session status
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Check current password
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Validate new password
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password); // Update password securely
        $user->save();

        return Redirect::route('user.account.tab', ['tab' => 'account'])
            ->with('status', 'password-updated'); // Flash session status
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
