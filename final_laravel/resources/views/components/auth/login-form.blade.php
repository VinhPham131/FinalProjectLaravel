<div class="p-8 space-y-8 w-full">
    <!-- Title -->
    <h2 class="text-4xl text-gray-800 mb-6 text-center">{{ __('Welcome Back') }}</h2>

    <!-- Form -->
    <form wire:submit.prevent="login" class="space-y-4 justify-center">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" class="block text-sm font-medium text-gray-700" :value="__('Email')" />
            <x-text-input id="email" type="text" name="email" placeholder="you@example.com" :value="old('email')"
                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                wire:model.defer="email" wire:loading.attr="disabled" autofocus autocomplete="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" class="block text-sm font-medium text-gray-700" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" placeholder="********" :value="old('password')"
                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                wire:model.defer="password" wire:loading.attr="disabled" autocomplete="current-password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="space-y-2 flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-opacity-50"
                wire:model.defer="remember" wire:loading.attr="disabled">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
        </div>

        <!-- Error Message -->
        @if ($errors->has('login.failed'))
            <div class="mt-4">
                <x-input-error :messages="$errors->get('login.failed')" class="mb-4" />
            </div>
        @endif

        <!-- Forgot Password -->
        @if (Route::has('password.request'))
            <a class="text-base text-amber-600 hover:text-amber-800 cursor-pointer mt-4" href="{{ route('password.request') }}"
                wire:loading.attr="disabled">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <div class="flex justify-between items-baseline space-y-4">
            <a wire:click.prevent="switchMode('register')" wire:loading.attr="disabled"
                class="text-base text-amber-600 hover:text-amber-800 cursor-pointer">{{ __("Don't have an account'? Sign up") }}</a>
            <x-primary-button type="submit" wire:loading.attr="disabled" loading="Logging in..." target="login"
                class="bg-stone-950 text-white px-4 rounded-lg hover:bg-stone-800 focus:ring focus:ring-stone-500 focus:ring-opacity-50">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex justify-end items-center space-y-4">

        </div>
    </form>
</div>