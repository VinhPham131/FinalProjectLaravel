@extends('layouts.app')

@section('title', 'User')

@section('content')

    <div class="flex tablet:mx-[160px] max-w-[1200px] ">
    <!-- Sidebar -->
    <aside class="mt-0 max-w-[220px] w-[220px] bg-white shadow-lg h-screen hidden md:block">
    <div class="h-full px-4 py-6">
        <!-- Avatar Section -->
        <div class="flex flex-col items-center mb-6">
            <!-- Avatar -->
            <div class="relative w-20 h-20 rounded-full bg-gray-200 overflow-hidden border-2 border-gray-300">
                <!-- Hiển thị avatar -->
                @if (Auth::user()->avatar_url)
    <img src="{{ asset(Auth::user()->avatar_url) }}" alt="User Avatar" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
@else
    <p>No avatar uploaded</p>
@endif
                <label for="avatar-upload" class="absolute bottom-0 right-0 w-6 h-6 bg-gray-800 rounded-full flex items-center justify-center cursor-pointer">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12h14m-7-7v14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </label>
                <input type="file" id="avatar-upload" name="avatar" class="hidden" onchange="document.getElementById('avatar-form').submit();">
            </div>

            <!-- User Info -->
            <p class="mt-3 text-lg font-semibold text-gray-700">{{ $user->name }}</p>
            <span class="text-sm text-gray-500">{{ $user->email }}</span>
        </div>

        <!-- Upload Form -->
        <form id="avatar-form" action="{{ route('user.updateAvatar') }}" method="POST" enctype="multipart/form-data" class="hidden">
            @csrf
            <!-- Input cho file avatar -->
            <input type="file" id="avatar-input" name="avatar">
        </form>

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
                    <span class="ml-3">Orders</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

    <!-- Nội dung chính -->
    <main class="flex-1 p-4 bg-white">
    <!-- Profile Content -->
    @livewire('profile-content')
    
    </main>
    </div>

</section>
@endsection