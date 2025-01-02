<div class="p-8 space-y-8 w-full">
    <!-- Title -->
    <h2 class="text-4xl text-gray-800 mb-6 text-center">{{ __('Create your account') }}</h2>

    @if ($this->emailSent)
        <!-- Success Message -->
        <div class="p-4 bg-green-100 text-green-700 rounded-md text-center">
            {{ __('Registration successful! You can now log in to your account.') }}
            <a wire:click.prevent="switchMode('login')" class="text-amber-600 hover:text-amber-800 cursor-pointer">
                {{ __('Go to Login') }}
            </a>
        </div>
    @endif
    <!-- Form -->
    <form wire:submit.prevent="register" class="space-y-4 justify-center" @if ($this->registrationComplete) style="display: none;" @endif>
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" class="block text-sm font-medium text-gray-700" :value="__('Name')" />
            <x-text-input id="name" type="text" placeholder="What should we call you?" wire:model.defer="name"
                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" class="block text-sm font-medium text-gray-700" :value="__('Email')" />
            <x-text-input id="email" type="text" placeholder="example@email.com" wire:model.defer="email"
                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</x-input-label>
            <x-text-input id="password" type="password" placeholder="Must be at least 8 characters"
                wire:model.defer="password" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</x-input-label>
            <x-text-input id="password_confirmation" type="password" placeholder="Re-enter your password"
                wire:model.defer="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        @if ($errors->has('auth.failed'))
        <div class="mt-4">
            <x-input-error :messages="$errors->get('auth.failed')" class="mb-4" />
        </div>
    @endif

        <div class="flex justify-between items-baseline">
            <a wire:click.prevent="switchMode('login')" class="text-base text-amber-600 hover:text-amber-800 cursor-pointer">
                {{ __('Already registered? Login') }}
            </a>
            <x-primary-button type="submit" wire:loading.attr="disabled"
            class="bg-stone-950 text-white px-4 rounded-lg hover:bg-stone-800 focus:ring focus:ring-stone-500 focus:ring-opacity-50">
            <span wire:loading.remove>{{ __('Register') }}</span>
            <span wire:loading>{{ __('Please wait...') }}</span>
        </x-primary-button>
                </div>
    </form>

    @if ($this->registrationComplete)
    <div class="flex justify-center">
        <button type="button" wire:click="closeManually"
            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50">
            {{ __('Close') }}
        </button>
    </div>
@endif
</div>