@extends('layouts.app')
@section('content')
<div class="flex justify-between gap-10 mx-[160px] ">
    <!-- Sidebar -->
    <aside class="w-[250px] bg-white h-screen p-6 text-gray-800 rounded-lg shadow-xl border border-gray-300">
        <div class="text-center mb-8">
            <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                alt="User Profile"
                class="rounded-full w-[100px] mx-auto shadow-sm">
            <div class="mt-4">
                <p class="text-lg font-semibold tracking-wide text-gray-800 uppercase">{{ Auth::user()->name }}</p>
                <p class="text-sm font-light text-gray-500">{{ Auth::user()->email }}</p>
                @livewire('profile-content', ['user' => Auth::user()])
            </div>
        </div>
        <ul class="space-y-3">
            <li>
                <a href="{{ route('user.account.tab', ['tab' => 'cart']) }}"
                    class="block px-4 py-3 rounded-lg text-lg font-medium text-gray-800 {{ $activeTab === 'cart' ? 'bg-gray-800 text-white shadow-inner' : 'hover:bg-gray-200 hover:text-a28b68' }}">
                    <i class="fas fa-shopping-cart mr-2"></i> My Cart
                </a>
            </li>
            <li>
                <a href="{{ route('user.account.tab', ['tab' => 'order']) }}"
                    class="block px-4 py-3 rounded-lg text-lg font-medium text-gray-800 {{ $activeTab === 'order' ? 'bg-gray-800 text-white shadow-inner' : 'hover:bg-gray-200 hover:text-a28b68' }}">
                    <i class="fas fa-box-open mr-2"></i> My Orders
                </a>
            </li>
            <li>
                <a href="{{ route('user.account.tab', ['tab' => 'account']) }}"
                    class="block px-4 py-3 rounded-lg text-lg font-medium text-gray-800 {{ $activeTab === 'account' ? 'bg-gray-800 text-white shadow-inner' : 'hover:bg-gray-200 hover:text-a28b68' }}">
                    <i class="fas fa-user-cog mr-2"></i> Account
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="flex">
                        <button type="submit"
                            class="block px-4 py-3 rounded-lg text-[15px] font-medium text-gray-400 ">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign out
                        </button>
                    </div>
                </form>
            </li>
        </ul>
    </aside>
    <!-- Main Content -->
    <div class="flex-1">
        @if ($activeTab === 'cart')
        <h1 class="text-2xl font-bold">My Cart</h1>
        @livewire('cart', ['viewType' => 'full'])
        @elseif ($activeTab === 'order')
        <h1 class="text-2xl font-bold">My Order</h1>

        @include('components.account.order', ['orders' => $orders])
        @elseif ($activeTab === 'account')
        <h1 class="text-2xl font-bold">My Account</h1>
        @include('components.account.accountEdit', ['user' => $user])
        @endif
    </div>
</div>
@endsection