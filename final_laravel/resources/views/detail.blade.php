@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
<x-breadcrumbs />   
<section class="grid justify-center laptop:ml-28">
@include('components/productdetail')
    <!-- Related Products -->
    <h3 class="font-garamond cursor-pointer font-bold text-[25px] pb-3.75 mb-10 mt-10 max-[431px]:mx-5">
        <a class="border-b-2 border-yellow-700">Related Products</a>
    </h3>
    <section class="grid justify-center">
        <section class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 max-w-[1200px] gap-4 px-4">
            @foreach ($related_products as $item)
                @include('components.products', ['item' => $item])
            @endforeach
        </section>
    </section>

</section>
<script src="{{ asset('js/productslide.js') }}"></script>
@endsection