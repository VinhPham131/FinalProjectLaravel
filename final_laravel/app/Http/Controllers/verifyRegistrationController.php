<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\VerifyEmailResponse;

class verifyRegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
            throw new AuthorizationException;
        }

        // if ($user->hasVerifiedEmail()) {
        //     return redirect()->route('home');
        // }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Automatically log in the user
        Auth::login($user);

        return redirect()->route('home');
    }
}
