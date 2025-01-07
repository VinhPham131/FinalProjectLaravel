<div class="mt-8 mx-auto max-w-[1100px] w-full p-4 border border-gray-200 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

    <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-2 gap-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 ">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-[370px] rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm ">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-[370px] rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm font-bold text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <section class="mt-8">
        <h2 class="text-xl font-bold mb-4">Change Password</h2>
        <form method="POST" action="{{ route('user-password.update') }}" class="grid grid-cols-1 gap-6">
            @csrf
            @method('put')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password" required class="mt-1 block w-[700px] rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach ($errors->updatePassword->get('current_password') as $message)
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @endforeach
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-[700px] rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach ($errors->updatePassword->get('password') as $message)
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @endforeach
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-[700px] rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @endforeach
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 dark:text-green-400">{{ __('Password updated.') }}</p>
                @endif

            </div>
        </form>
    </section>
</div>