@extends('layouts.app')

@section('title', 'Orders')

@section('content')

<div class="flex tablet:mx-[160px] max-w-[1200px] ">
    <!-- Sidebar -->
    <aside class="mt-0 max-w-[220px] w-[220px] bg-white shadow-lg h-screen hidden md:block">
    <div class="h-full px-4 py-6">
        <!-- Avatar Section -->
        <div class="flex flex-col items-center mb-6">
        <form action="{{ route('user.updateAvatar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="avatar">Upload Avatar</label>
    <input type="file" name="avatar" id="avatar" required>
    <button type="submit">Upload</button>
</form>
            <p class="mt-3 text-lg font-semibold text-gray-700">{{ $user->name }}</p>
            <span class="text-sm text-gray-500">{{ $user->email }}</span>
        </div>

        <ul class="space-y-4">
            <!-- Nút Settings -->
            <li>
                <a href="{{ route('user.profile') }}"
                    class="flex items-center p-3 text-base font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-300 {{ request()->routeIs('user.profile') ? 'bg-gray-100' : '' }}">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2a5 5 0 100 10 5 5 0 000-10zm-1 5h2a1 1 0 010 2h-2a1 1 0 010-2zm7 13H6a2 2 0 01-2-2v-4a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2z" />
                    </svg>
                    <span class="ml-3">Settings</span>
                </a>
            </li>
            <!-- Nút Orders -->
            <li>
                <a href="{{ route('user.order') }}"
                    class="flex items-center p-3 text-base font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-300 {{ request()->routeIs('user.order') ? 'bg-gray-100' : '' }}">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4h16v2H4zm0 14h16v2H4zM2 8h20v8H2z" />
                    </svg>
                    <span class="ml-3">My Cart</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
    <!-- Order Content -->
    <div class="mt-5 mx-auto max-w-[1200px] w-full p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
    @livewire('cart', ['viewType' => 'full'])
@endsection
