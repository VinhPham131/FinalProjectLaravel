<div>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">{{ __('Register') }}</h2>
    <form wire:submit.prevent="register">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <input id="name" type="text" wire:model.defer="name" 
                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   required />
            @error('name') 
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <input id="email" type="email" wire:model.defer="email" 
                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   required />
            @error('email') 
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
            <input id="password" type="password" wire:model.defer="password" 
                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   required />
            @error('password') 
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" wire:model.defer="password_confirmation" 
                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   required />
            @error('password_confirmation') 
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <button type="button" wire:click.prevent="switchMode('login')" 
                    class="text-sm underline text-blue-600 hover:text-blue-800">{{ __('Already registered? Login') }}</button>
            <button type="submit" 
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
