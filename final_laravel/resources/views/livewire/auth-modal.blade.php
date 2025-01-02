<div class="flex-row justify-between">
    <div class="relative w-full flex items-center">
        <!-- Logo icon -->
        <div class="absolute left-1/2 transform -translate-x-1/2 pt-6">
            <x-logo-icon />
        </div>

        <!-- Close button -->
        <div class="ml-auto p-2">
            <button type="button" wire:click="closeManually"
                class="text-gray-300 hover:text-gray-600 focus:ring focus:ring-gray-500 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div class="flex justify-center">
        @if ($mode == 'login')
            <x-auth.login-form />
        @elseif ($mode == 'register')
            <x-auth.register-form />
        @endif
    </div>
</div>