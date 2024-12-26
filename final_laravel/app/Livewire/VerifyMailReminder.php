<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VerifyMailReminder extends Component
{
    public $isVerified;

    public function mount()
    {
        $this->isVerified = Auth::user()->hasVerifiedEmail();
        if ($this->isVerified) {
            session()->forget('countdown'); // Remove countdown from session
        }
    }

    public function render()
    {
        return view('livewire.verify-mail-reminder');
    }

    public function checkVerification()
    {
        $this->isVerified = Auth::user()->hasVerifiedEmail();
    }
}
