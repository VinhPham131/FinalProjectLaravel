@extends('layouts.app')

@section('title', 'User')

@section('content')
<section class="flex w-screen">
    <!-- Nút Profile và Order -->
    <div
        class="grid tablet:grid-cols-3 laptop:grid-cols-4 tablet:mx-[200px] max-w-[1200px] laptop:w-[calc(1200px-100px)] tablet:max-laptop:w-[calc(1200px-350px)] phone:max-tablet:mb-5 phone:max-tablet:w-screen">
        <div class="flex space-x-2">
            <!-- Nút Profile -->
            <a href="{{ route('user.cart') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                My Cart
            </a>
            <!-- Nút Account -->
            <a href="{{ route('user.account') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active">
                Account
            </a>

            <a href="{{ route('user.order') }}"
                class="inline-block w-max p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                My Orders
        </div>
    </div>
    <div>
        <!-- Profile Content -->
        @livewire('profile-content')
    </div>

</section>
@endsection