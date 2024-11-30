@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<style>
   #carousel-container {
    width: 100%;
    overflow: hidden; /* Ẩn nội dung ngoài khung */
}

#carousel-images {
    display: flex;
    transition: transform 0.7s ease-in-out; /* Hiệu ứng chuyển slide */
}

#carousel-images > div {
    flex: 0 0 33.3333%; /* Mỗi ảnh chiếm 1/3 chiều rộng container */
    max-width: 33.3333%; /* Đảm bảo luôn hiển thị 3 ảnh */
}

</style>

<section class="grid justify-center">
    <!-- Video Section -->
    <div class="max-w-[1200px] tablet:mx-auto phone:mx-[10px]">
        <video class="w-full h-auto focus:outline-none" muted autoplay loop>
            <source type="video/mp4" src="/vid/Video_Tiffani.mp4">
        </video>
    </div>

    <div id="carousel-container" class="relative w-full overflow-hidden">
    <!-- Wrapper for images -->
    <div id="carousel-images" class="flex transition-transform duration-700 ease-in-out gap-5 max-w-[1200px] mt-5 ">
        @foreach ($slideshowImages as $url)
            <div class="flex-shrink-0 w-1/3">
                <img src="{{ $url }}" 
                     class="w-full h-[300px] object-cover" 
                     alt="Slideshow image">
            </div>
        @endforeach
    </div>

    <!-- Indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
        @foreach ($slideshowImages as $index => $url)
            <button type="button" class="w-3 h-3 rounded-full bg-white"
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                    data-carousel-slide-to="{{ $index }}" 
                    onclick="goToSlide({{ $index }})"></button>
        @endforeach
    </div>

    <!-- Navigation controls -->
    <button class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer" onclick="prevSlide()">
        <span class="inline-flex items-center justify-center w-10 h-10 bg-white/30 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </span>
    </button>
    <button class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer" onclick="nextSlide()">
        <span class="inline-flex items-center justify-center w-10 h-10 bg-white/30 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </span>
    </button>
</div>


    <!-- Shop Section -->
    <main>
        <section class="grid justify-center">
            <section
                class="flex justify-between mt-14 font-medium my-10 mx-auto max-w-[1200px] phone:w-[calc(400px-20px)] tablet:w-[calc(1000px-100px)] laptop:w-[calc(1250px-50px)]">
                <h2 class="font-garamond flex-auto tablet:text-4xl phone:text-2xl leading-10 text-black">
                    Shop The Latest
                </h2>
                <a href="/shop"
                    class="font-garamond my-auto tablet:text-xl leading-7 capitalize text-stone-500 phone:text-sm">
                    View All
                </a>
            </section>
        </section>

        <!-- Product Grid -->
        <section class="grid justify-center mb-10">
            <section
                class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] gap-4 px-4">
                @foreach ($products as $item)
                    @include('components.products', ['item' => $item])
                @endforeach
            </section>
        </section>

    </main>
    <!-- Banner Section -->
    <!-- <section class="tablet:grid tablet:justify-center">
        <div class="phone:mx-auto tablet:mx-[200px] max-w-[1300px] phone:w-full phone:h-[200px] tablet:w-[800px] tablet:h-[350px] laptop:w-[1200px] laptop:h-[500px] bg-cover bg-center  "
            style="background-image: url('https://file.hstatic.net/200000103143/file/2880x1040_08e287342f01452c9a706ec67d1f592a.jpg">
        </div>
    </section> -->
    
</section>


<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-24 mx-auto max-w-[1200px] phone:w-[calc(400px-20px)] tablet:w-[calc(1000px-100px)] laptop:w-[calc(1250px-50px)]">
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5700418_ms1/matrix-drop-earrings--mixed-cuts--white--rhodium-plated-swarovski-5700418.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5693154_ms1/matrix-bracelet--mixed-cuts--white--rhodium-plated-swarovski-5693154.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5692533_ms1/matrix-y-necklace--mixed-cuts--white--rhodium-plated-swarovski-5692533.jpg" alt="">
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_2000/t_swa002/c_scale,dpr_2.0,f_auto,w_2000/5698546_ms1/hyperbola-necklace--mixed-cuts--white--rhodium-plated-swarovski-5698546.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_2000/t_swa002/c_scale,dpr_2.0,f_auto,w_2000/5469989_ms1/swan-necklace--swan--pink--rose-gold-tone-plated-swarovski-5469989.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5472271_ms1/swan-bracelet--magnetic-closure--swan--pink--rose-gold-tone-plated-swarovski-5472271.jpg" alt="">
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5642978_ms1/teddy-bracelet--bear--pink--rose-gold-tone-plated-swarovski-5642978.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5662114_ms1/bella-v-drop-earrings--round-cut--pink--rose-gold-tone-plated-swarovski-5662114.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5662088_ms1/bella-v-pendant--round-cut--pink--rose-gold-tone-plated-swarovski-5662088.jpg" alt="">
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5662918_ms1/chroma-necklace--mixed-cuts--multicolored--gold-tone-plated-swarovski-5662918.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5652822_ms1/gema-bracelet--mixed-cuts--green--gold-tone-plated-swarovski-5652822.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://asset.swarovski.com/images/$size_1450/t_swa002/c_scale,dpr_2.0,f_auto,w_675/5652801_ms1/gema-drop-earrings--mixed-cuts--green--gold-tone-plated-swarovski-5652801.jpg" alt="">
        </div>
    </div>
</div>
<script src="/js/slide.js"> </script>

@endsection