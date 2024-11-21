@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
<section class="grid justify-center laptop:ml-28">
    <div class="new-product-head-wrap flex flex-wrap relative mx-[200px] max-w-[1200px] max-[431px]:mx-0 laptop:w-[calc(1400px-200px)] phone:max-tablet:grid phone:max-tablet:justify-center phone:max-tablet:p-10">
       <!-- Slideshow Container -->
        <div class="slideshow-container relative mb-2 laptop:mt-5 max-[431px]:mx-0 border-2 border-gray-700 tablet:w-[605px] tablet:h-[555px] mt-5">
            @foreach ($product->images as $image)
                @foreach ($image->urls as $index => $url)
                    <div class="mySlides fade hidden" data-slide="{{ $index }}">
                        <img src="{{ $url }}" class="w-[600px] h-[550px] phone:max-tablet:w-full phone:max-tablet:h-full" alt="Image {{ $index + 1 }}">
                    </div>
                @endforeach
            @endforeach

            <!-- Navigation Buttons -->
            <a class="prev cursor-pointer absolute top-1/2 transform -translate-y-1/2 left-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-r-md select-none" onclick="changeSlide(-1)">&#10094;</a>
            <a class="next cursor-pointer absolute top-1/2 transform -translate-y-1/2 right-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-l-md select-none" onclick="changeSlide(1)">&#10095;</a>
        </div>

        <!-- Thumbnail Images -->
        <div class="flex gap-2 justify-center mt-4">
            @foreach ($product->images as $image)
                @foreach ($image->urls as $index => $url)
                    <img src="{{ $url }}" alt="Thumbnail {{ $index + 1 }}" class="thumbnail cursor-pointer w-[80px] h-[80px] object-cover border-2 border-gray-300 hover:border-yellow-500" data-slide="{{ $index }}" onclick="showSlide({{ $index }})">
                @endforeach
            @endforeach
        </div>

        <!-- Product Info -->
        <div class="new-product-info w-full md:w-1/3 max-w-[360px] mx-auto sticky top-[140px] h-min-content md:max-w-[85%] md:mt-4">
            <h1 class="font-roboto new-product-title font-bold text-[25px] mt-2.5">{{ $product->name }}</h1>
            <div class="new-product-info-prices flex justify-center items-center text-sm">
                <b class="bg-pink-200 text-gray-800 inline-block px-2.5 py-1 font-bold mx-1.5">${{ $product->price - $product->sales }}</b>
                <del class="mx-1.5">${{ $product->price }}</del>
                @php
                    $salePercentage = (($product->sales / $product->price) * 100);
                @endphp
                <span class="bg-gray-800 text-white inline-block px-2.5 py-1 font-medium mx-1.5">-{{ number_format($salePercentage, 0) }}%</span>
            </div>
        </div>
    </div>

    <!-- Product Description -->
    <div class="new-container mx-[200px] max-w-[1200px] max-[431px]:mx-0">
        <div class="new-product-content border-b border-gray-300 tablet:my-10">
            <h3 class="font-roboto cursor-pointer font-bold text-2xl pb-3.75">
                <a class="border-b-2 border-yellow-700 my-3">Product Information</a>
            </h3>
            <p class="tracking-wide font-roboto mt-2 mb-3 leading-5 text-lg max-w-[1100px]">
                {{ $product->description }}
            </p>
            <p class="tracking-wide font-roboto mt-2.5 text-lg mb-5">
                Collection: {{ $product->collection }}<br>
                Product Code: {{ $product->productcode }}<br>
                Classification: {{ $product->category }}<br>
                Material: {{ $product->material }}<br>
                Color: {{ $product->color }}
            </p>
        </div>
    </div>

    <!-- Related Products -->
    <h3 class="font-roboto cursor-pointer font-bold text-[25px] pb-3.75 mb-10 mt-10">
        <a class="border-b-2 border-yellow-700">Related Products</a>
    </h3>
    <section class="grid justify-center">
        <section class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] gap-4 px-4">
            @foreach ($products as $item)
                <div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[260px] tablet:h-[260px] shadow-md">
                    <a href="{{ route('detail', $item->id) }}">
                        <div class="bg-gray-100 rounded-lg phone:h-[180px] phone:w-[180px] tablet:w-[260px] tablet:h-[260px]">
                        <img src="{{ $item->images->first()->first_url }}" alt="{{ $item->name }}" class="rounded w-full h-full object-cover" onerror="this.onerror=null;this.src='/path/to/fallback-image.jpg';">                      
                        </div>
                        <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">{{ $item->name }}</h3>
                        <h4 class="text-center font-roboto phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
                            <font color="#a28b68">${{ $item->price - $item->sales }}</font>
                        </h4>
                    </a>
                </div>
            @endforeach
        </section>
    </section>
</section>

@endsection
