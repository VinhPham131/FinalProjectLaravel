@extends('layouts.app')

@section('title', 'Edit Account')

@section('content')
<section class="grid justify-center w-screen">
    <!-- Navigation Buttons -->
    <div
        class="grid tablet:grid-cols-3 laptop:grid-cols-4 tablet:mx-[200px] max-w-[1200px] laptop:w-[calc(1200px-100px)] tablet:max-laptop:w-[calc(1200px-350px)] phone:max-tablet:mb-5 phone:max-tablet:w-screen">
        <div class="flex space-x-2">
            <!-- Nút Profile -->
            <a href="{{ route('user.profile') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Profile
            </a>
            <!-- Nút Orders -->
            <a href="{{ route('user.order') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Orders
            </a>
            <!-- Nút Account -->
            <a href="{{ route('user.account') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active">
                Account
            </a>
            <a href="{{ route('user.wishlist') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Wish List
            </a>
        </div>
    </div>
    <div class="mt-8 mx-auto max-w-[1100px] w-full p-4 border border-gray-200 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Account</h1>

        <!-- Email (Static) -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Email Address</h2>
            <p class="text-gray-600">comeheretnt@gmail.com</p>
            <p class="text-sm text-gray-500">Your email address is static and cannot be changed.</p>
        </div>

        <!-- Change Password -->
        <form>
            <div class="mb-4">
                <label for="new_password" class="block text-lg font-semibold mb-2">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="Enter new password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block text-lg font-semibold mb-2">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                Save Changes
            </button>
        </form>
    </div>
</section>
@endsection