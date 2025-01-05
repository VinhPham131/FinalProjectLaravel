@extends('layouts.app')

@section('content')
<div class="flex justify-between gap-10 mx-[180px] ">
    <!-- Sidebar -->
    <aside class="w-[250px] bg-gray-100 h-screen p-4">
        <div>
            <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                alt="Image description"
                class="shrink-0 self-center w-[100px]"/>
            <div class="flex gap-2">
                <span>Name:</span>
                <p>{{ Auth::user()->name }}</p>
            </div>
            <div class="flex gap-2">
                <span>Email:</span>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('user.account.tab', ['tab' => 'cart']) }}"
                    class="block px-4 py-2 rounded-lg {{ $activeTab === 'cart' ? 'bg-gray-800 text-white' : 'hover:bg-gray-200' }}">
                    My Cart
                </a>
            </li>
            <li>
                <a href="{{ route('user.account.tab', ['tab' => 'order']) }}"
                    class="block px-4 py-2 rounded-lg {{ $activeTab === 'order' ? 'bg-gray-800 text-white' : 'hover:bg-gray-200' }}">
                    My Orders
                </a>
            </li>
            <li>
                <a href="{{ route('user.account.tab', ['tab' => 'account']) }}"
                    class="block px-4 py-2 rounded-lg {{ $activeTab === 'account' ? 'bg-gray-800 text-white' : 'hover:bg-gray-200' }}">
                    Account
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        @if ($activeTab === 'cart')
            @livewire('cart', ['viewType' => 'full'])
        @elseif ($activeTab === 'order')
            <h1 class="text-3xl font-semibold mb-6">My Orders</h1>
            <p>Here are your orders.</p>
        @elseif ($activeTab === 'account')
            <h1 class="text-2xl font-bold">Edit Account</h1>
            @include('components.account-edit-form')
        @endif
    </div>
</div>
@endsection