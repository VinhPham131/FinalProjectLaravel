<div>

    @if (!$user->hasVerifiedEmail())
    <button wire:click="sendVerificationEmail" wire:loading.attr="disabled" wire:target="sendVerificationEmail"
        class="text-amber-600 hover:text-amber-800 cursor-pointer" @if($cooldown) disabled @endif>
        <span wire:loading.remove
            wire:target="sendVerificationEmail">{{ $cooldown > 0 ? 'Resend Verification Email' : 'Send Verification Email' }}</span>
        <span wire:loading wire:target="sendVerificationEmail">Sending...</span>
    </button>

    <!-- Countdown Timer -->
    <span wire:poll.1s="decrementCountdown" x-show="countdown > 0" class="text-gray-500 text-sm"
        x-data="{ countdown: @entangle('countdown') }">
        (Resend available in <span x-text="countdown"></span>s)
    </span>

    <!-- Respone Message -->
    @if ($status === 'verification-link-sent')
    <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="text-green-500 text-sm">Verification link sent!</span>
    @endif

    @if ($status === 'verification-failed')
    <span x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="text-red-500 text-sm">Failed to send verification link. Please try again.</span>
    @endif
    @else
    <span class="text-green-500 text-sm">Verified <i class="fas fa-check-circle"></i></span>
    @endif
</div>