@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<section class="grid justify-center w-screen">
    <!-- Nút Profile và Order -->
    @include('components.side-bar-user', ['activeTab' => $activeTab])
    </div>
</section>
@endsection