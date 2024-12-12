<form wire:submit.prevent="login">
    @csrf
    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" placeholder="Your Email" :value="old('email')"
            class="block mt-1 w-full dark:bg-gray-900" wire:model="email" wire:loading.attr="disabled" autofocus
            autocomplete="email" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" placeholder="Your Password"
            :value="old('password')" class="block mt-1 w-full dark:bg-gray-900" wire:model="password"
            wire:loading.attr="disabled" autocomplete="current-password" required />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                wire:model="remember" wire:loading.attr="disabled">
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
        </label>
    </div>

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="mt-4">
            <x-input-error :messages="session('error')" class="mb-4" />
        </div>
    @endif


    <div class="flex items-center justify-between">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <x-primary-button class="ms-3" wire:loading.attr="disabled" loading="Logging..">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</div>
</form>
