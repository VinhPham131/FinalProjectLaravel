<div class="mt-5 mx-auto max-w-[1200px] w-full p-8 bg-gradient-to-br from-gray-50 to-white border border-gray-200 shadow-xl rounded-lg">
    <!-- Profile Section -->
    <h1 class="text-4xl font-bold text-gray-800 mb-10 border-b border-gray-300 pb-4">My Profile</h1>
    <div class="space-y-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Preferred Name</h2>
                <p class="text-gray-600 text-lg">{{ $user->name }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Email</h2>
                <p class="text-gray-600 text-lg">{{ $user->email }}</p>
                @if (!$user->hasVerifiedEmail())
                    <button class="mt-2 px-4 py-2 bg-amber-500 text-white text-sm rounded-md shadow-md hover:bg-amber-600 focus:ring-2 focus:ring-amber-300 focus:outline-none">Verify Email</button>
                @else
                    <span class="text-green-500 font-medium text-sm flex items-center">Verified <i class="fas fa-check-circle ml-1"></i></span>
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Account Section -->
    <h2 class="text-3xl font-bold text-gray-800 mt-12 mb-8">Edit Account</h2>
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="mt-2 block w-full border border-gray-300 shadow-sm rounded-md focus:ring-gray-600 focus:border-gray-600 sm:text-lg">
            </div>
            <div>
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       class="mt-2 block w-full border border-gray-300 shadow-sm rounded-md focus:ring-gray-600 focus:border-gray-600 sm:text-lg">
            </div>
        </div>
        <button type="submit"
                class="block w-full max-w-[300px] mx-auto px-6 py-3 bg-gray-800 text-white text-lg font-semibold rounded-md shadow-md hover:bg-gray-900 focus:ring-2 focus:ring-gray-600 focus:outline-none">
            Save Changes
        </button>
    </form>

    <!-- Change Password Section -->
    <h2 class="text-3xl font-bold text-gray-800 mt-12 mb-8">Change Password</h2>
    <form method="POST" action="{{ route('user-password.update') }}" class="space-y-6">
        @csrf
        @method('put')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label for="current_password" class="block text-lg font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password" required
                       class="mt-2 block w-full border border-gray-300 shadow-sm rounded-md focus:ring-gray-600 focus:border-gray-600 sm:text-lg">
            </div>
            <div>
                <label for="password" class="block text-lg font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password" required
                       class="mt-2 block w-full border border-gray-300 shadow-sm rounded-md focus:ring-gray-600 focus:border-gray-600 sm:text-lg">
            </div>
        </div>
        <div>
            <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="mt-2 block w-full border border-gray-300 shadow-sm rounded-md focus:ring-gray-600 focus:border-gray-600 sm:text-lg">
        </div>
        <button type="submit"
                class="block w-full max-w-[300px] mx-auto px-6 py-3 bg-gray-800 text-white text-lg font-semibold rounded-md shadow-md hover:bg-gray-900 focus:ring-2 focus:ring-gray-600 focus:outline-none">
            Update Password
        </button>
    </form>
</div>
