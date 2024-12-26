<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileContent extends Component
{
    public $user;
    public $cooldown = false;
    public $countdown = 0;
    public $status = null;

    // The cooldown time in seconds
    protected $cooldownTime = 60;

    public function mount()
    {
        $this->user = Auth::user();

        // If a cooldown is active, restore countdown from session
        if (session()->has('countdown')) {
            $this->cooldown = true;
            $this->countdown = session('countdown', $this->cooldownTime);
        }
    }

    public function sendVerificationEmail()
    {
        // Check if the email is already verified
        if ($this->user->hasVerifiedEmail()) {
            $this->status = 'already-verified';
            return;
        }

        // Send email verification and check response
        if ($this->user->sendEmailVerificationNotification()) {
            // Success: Start the cooldown
            $this->cooldown = true;
            $this->status = 'verification-link-sent';

            // Initialize countdown
            $this->countdown = $this->cooldownTime;
            session(['countdown' => $this->countdown]);

            // Start the countdown
            $this->startCountdown();
        } else {
            // Failure: Set status
            $this->status = 'verification-failed';
        }
    }

    public function startCountdown()
    {
        // Trigger a countdown decrement every second
        $this->dispatch('start-countdown');
    }

    public function decrementCountdown()
    {
        // Only decrement the countdown if greater than 0
        if ($this->countdown > 0) {
            $this->countdown--;
            session(['countdown' => $this->countdown]); // Update session with new countdown value
        }

        // If countdown reaches zero, remove it from session
        if ($this->countdown === 0) {
            session()->forget('countdown'); // Remove countdown from session
            $this->cooldown = false; // Reset cooldown flag
        }
    }

    public function render()
    {
        return view('livewire.profile-content');
    }
}
