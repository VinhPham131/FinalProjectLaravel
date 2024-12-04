<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class LoginModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.login-modal');
    }
}