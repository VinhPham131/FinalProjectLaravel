@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<section class="grid justify-center w-screen">
    <!-- Nút Profile và Order -->
    @include('components.side-bar-user', ['activeTab' => $activeTab])    
    @livewire('cart', ['viewType' => 'full'])

</section>
@endsection