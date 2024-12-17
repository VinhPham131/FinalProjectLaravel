@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
    <x-breadcrumbs />
    <section class="grid justify-center laptop:ml-28">
        @livewire('product-detail', ['product' => $product])
    </section>
    
    <script src="{{ asset('js/productslide.js') }}"></script>
@endsection
