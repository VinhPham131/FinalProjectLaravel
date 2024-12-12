<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginModal extends ModalComponent
{
    public $email;
    public $password;
    public $remember=false;
    public $currentPath;

    protected $rules = [
        'email' => 'required|email|string',
        'password' => 'required|string',
        'remember' => 'boolean',
    ];

    public function mount()
    {
        $this->currentPath = request()->header('Referer');
        if (Auth::viaRemember()) {
            $this->email = Auth::user()->email;
        } 
    }

    public function login(Request $request)
    {
        // Validate inputs
        $this->validate();

        if ($this->attemptLogin()) {
            $request->session()->regenerate();

            if ($this->remember) {
                session(['remembered_email' => $this->email]);
            }

            return redirect()->intended(); // Redirect to the current page
        }

        // Authentication failed
        session()->flash('error', __('auth.login_failed'));

        // Clear the password field for security
        $this->password = null;

        return;
    }

    protected function attemptLogin()
    {
        return $this->guard()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
    }
    protected function guard()
    {
        return Auth::guard();
    }

    public function render()
    {
        return view('livewire.login-modal');
    }
}