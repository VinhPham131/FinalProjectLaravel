<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;

class Footer extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
    ];

    public function submitContactForm()
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'message']);

        session()->flash('success', 'Thank you for your message!');
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
