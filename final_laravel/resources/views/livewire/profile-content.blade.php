<div class="mt-8 mx-auto max-w-[1100px] w-full p-4 border border-gray-200 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">PROFILE</h1>

    <div class="mb-4">
        <h2 class="text-lg font-semibold">Preferred Name</h2>
        <p class="text-gray-600">{{ $user->name }}</p>
        <a href="#" class="text-blue-500 hover:underline text-sm">EDIT PREFERRED NAME</a>
    </div>

    <div class="mb-4">
        <h2 class="text-lg font-semibold">Email</h2>
        <div class="flex items-center space-x-2">
            <p class="text-gray-600">{{ $user->email }}</p>

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
    </div>
</div>