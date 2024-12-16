<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Rules;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

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
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        $request = new LoginRequest([
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        $request->validate($request->rules());

        try {
            // Proceed with registration if validation passes
            $controller = new AuthenticatedSessionController();
            $controller->store($request);
            
            return redirect()->intended();

        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());
        }

        // Clear the password field for security
        $this->password = null;

        return;
    }


    public function register()
    {
        $this->validate();

        $request = new RegisterUserRequest([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        // Validate the request using the rules defined in RegisterUserRequest
        $validated = $request->validate($request->rules());

        try {
            // Proceed with registration if validation passes
            $controller = new RegisteredUserController();
            $controller->store($request);

            return redirect()->intended();
        } catch (ValidationException $e) {
            // Pass back validation errors to Livewire
            $this->setErrorBag($e->errors());
        }

        return;
    }

    public function render()
    {
        return view('livewire.auth-modal');
    }
}
