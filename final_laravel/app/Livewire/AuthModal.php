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

    protected function rules()
    {
        return match ($this->mode) {
            'login' => [
                'email' => 'required|email|string',
                'password' => 'required|string',
                'remember' => 'boolean',
            ],
            'register' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password'
            ],
            default => [],
        };
    }

    public function mount($mode)
    {
        $this->mode = $mode;


        if ($this->mode === 'login')
            $this->loadRememberedEmail();
    }

    protected function loadRememberedEmail()
    {
        $this->email = session('remembered_email', '');
    }

    public function switchMode($mode)
    {
        $this->resetForm();
        $this->mode = $mode;
    }

    protected function resetForm()
    {
        // Reset fields based on the mode
        if ($this->mode === 'login') {
            $this->name = '';
            $this->email = '';
            $this->password = '';
            $this->password_confirmation = '';
        } elseif ($this->mode === 'register') {
            $this->email = '';
            $this->password = '';
            $this->remember = false;
            $this->loadRememberedEmail();
        }

        $this->resetValidation();  // Reset validation state
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

            return redirect()->intended(); // Redirect to the current path
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

        // return Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        Auth::login($user);
        return redirect()->intended();
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
