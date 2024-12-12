<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class AuthModal extends ModalComponent
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $name = ''; // For registration
    public $password_confirmation = ''; // For registration
    public $mode = 'login'; // Default mode is login
    public $currentPath;

    protected $rules = [
        'email' => 'required|email|string',
        'password' => 'required|string',
        'remember' => 'boolean',
    ];

    public function switchMode($mode)
    {
        $this->resetValidation();
        $this->mode = $mode;
    }

    public function mount($mode)
    {
        $this->currentPath = request()->header('Referer');

        $this->mode = $mode;

        $this->email = session('remembered_email', ''); // Default to empty string if not found
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

            return redirect($this->currentPath); // Redirect to the current path
        }

        // Authentication failed
        session()->flash('error', __('auth.login_failed'));

        // Clear the password field for security
        $this->password = null;

        return;
    }

    protected function attemptLogin()
    {
        // return $this->guard()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember);

        return Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        Auth::login($user);
        return redirect(request()->header('Referer') ?? '/');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function render()
    {
        return view('livewire.auth-modal');
    }
}
