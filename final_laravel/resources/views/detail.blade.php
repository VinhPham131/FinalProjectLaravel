@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
<section class="grid justify-center laptop:ml-28">
    <div class="grid grid-cols-1 laptop:grid-cols-2 gap-10 max-w-[1200px] mx-auto laptop:mt-5">
        <!-- Left Column: Slideshow and Thumbnails -->
        <div class="slideshow-container relative">
            <!-- Slideshow -->
            <div class="relative border-2 border-gray-700 tablet:w-[605px] tablet:h-[555px] mt-5">
                @foreach ($product->images as $image)
                    @foreach ($image->urls as $index => $url)
                        <div class="mySlides fade hidden" data-slide="{{ $index }}">
                            <img src="{{ $url }}" class="w-[600px] h-[550px] phone:max-tablet:w-full phone:max-tablet:h-full"
                                alt="Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                @endforeach

                <!-- Navigation Buttons -->
                <a class="prev cursor-pointer absolute top-1/2 transform -translate-y-1/2 left-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-r-md select-none"
                    onclick="changeSlide(-1)">&#10094;</a>
                <a class="next cursor-pointer absolute top-1/2 transform -translate-y-1/2 right-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-l-md select-none"
                    onclick="changeSlide(1)">&#10095;</a>
            </div>

            <!-- Thumbnails -->
            <div class="justify-center flex gap-6 phone:mb-10 mt-5 ml-5">
                @foreach ($product->images as $image)
                    @foreach ($image->urls as $index => $url)
                        <img src="{{ $url }}" alt="Thumbnail {{ $index + 1 }}"
                            class="thumbnail w-[100px] h-[100px] object-cover opacity-40 hover:opacity-100 hover:border hover:border-gray-700"
                            data-slide="{{ $index }}" onclick="showSlide({{ $index }})">
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Right Column: Product Info -->
        <div class="new-product-info">
            <h1 class="font-roboto new-product-title font-bold text-[25px] mt-2.5">{{ $product->name }}</h1>
            <div class="new-product-info-prices flex justify-start items-center text-sm mt-4">
                @if ($product->highest_sale)
                    <b class="bg-pink-200 text-gray-800 inline-block px-2.5 py-1 font-bold mx-1.5">
                        ${{ number_format($product->discounted_price, 2) }}
                    </b>
                    <del class="mx-1.5">${{ number_format($product->price, 2) }}</del>
                    <span class="bg-gray-800 text-white inline-block px-2.5 py-1 font-medium mx-1.5">
                        -{{ $product->highest_sale }}%
                    </span>
                @else
                    <b class="bg-gray-800 text-white inline-block px-2.5 py-1 font-bold mx-1.5">
                        ${{ number_format($product->price, 2) }}
                    </b>
                @endif
            </div>

            <!-- Product Details -->
            <p class="tracking-wide font-roboto mt-4 text-lg">
                Collection: {{ $product->collection->name }}<br>
                Product Code: {{ $product->productcode }}<br>
                Classification: {{ $product->category->name ?? 'N/A' }}<br>
                Material: {{ $product->material }}<br>
                Color: {{ $product->color }}
            </p>
        </div>

    </div>

    <!-- Product Description -->
    <h3 class="font-roboto cursor-pointer font-bold text-2xl pb-3.75 max-[431px]:mx-5">
        <a class="border-b-2 border-yellow-700 my-3">Product Information</a>
    </h3>
    <div class="new-container mx-[50px] max-w-[1200px] max-[431px]:mx-10">

        <div class="new-product-content border-b border-gray-300 tablet:my-10">

            <p class="tracking-wide font-roboto mt-2 mb-3 leading-5 text-lg max-w-[1100px]">
                {{ $product->description }}
            </p>
            <p class="tracking-wide font-roboto mt-2.5 text-lg mb-5">
                Collection: {{ $product->collection->name }}<br>
                Product Code: {{ $product->productcode }}<br>
                Classification: {{ $product->category->name ?? 'N/A' }}<br>
                Material: {{ $product->material }}<br>
                Color: {{ $product->color }}
            </p>
        </div>
    </div>

    <!-- Related Products -->
    <h3 class="font-roboto cursor-pointer font-bold text-[25px] pb-3.75 mb-10 mt-10 max-[431px]:mx-5">
        <a class="border-b-2 border-yellow-700">Related Products</a>
    </h3>
    <section class="grid justify-center">
        <section class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] gap-4 px-4">
            @foreach ($products as $item)
                @include('components.products', ['item' => $item])
            @endforeach
        </section>
    </section>

</section>
<script src="{{ asset('js/productslide.js') }}"></script>
@endsection