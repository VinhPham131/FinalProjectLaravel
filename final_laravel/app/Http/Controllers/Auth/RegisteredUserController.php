<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // public function create(): View
    // {
    //     return view('auth.register');
    // }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Create the user after validation passes
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Send email verification (this might fail)
            $user->sendEmailVerificationNotification();
    
            // If email sending succeeds, commit the transaction
            DB::commit();
    
            // Return a JSON response for Livewire to handle
            return response()->json([
                'message' => trans('auth.registration_successful'),
            ]);
    
        } catch (\Exception $e) {
            // Rollback the transaction in case of error (like email sending failure)
            DB::rollBack();
    
            // Handle specific email sending failure
            if ($e instanceof \Swift_TransportException) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.email_verification_failed'),
                ]);
            }
    
            // Handle other exceptions (e.g., database or validation issues)
            throw ValidationException::withMessages([
                'auth.failed' => trans('auth.registration_failed'),
            ]);
        }
    }
}
