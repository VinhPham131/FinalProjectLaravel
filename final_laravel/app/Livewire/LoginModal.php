<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class LoginModal extends ModalComponent
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/'); // Redirect on success
        } else {
            // Add specific error messages based on conditions
            $user = \App\Models\User::where('email', $this->email)->first();
    
            if (!$user) {
                // If the email doesn't exist in the database
                $this->addError('email', __('login.email_not_found'));
            } elseif (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                // If the password is incorrect
                $this->addError('password', __('login.incorrect_password'));
            } else {
                // A fallback error message (should not be triggered in normal cases)
                $this->addError('email', __('login.invalid_credentials'));
            }
        }
    }    
    
    public function render()
    {
        return view('livewire.login-modal');
    }
}