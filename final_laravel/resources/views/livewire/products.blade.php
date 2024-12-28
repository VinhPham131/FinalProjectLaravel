<div>
<section class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] gap-4 px-4">
        @foreach ($products as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </section>

    <div class="text-center mt-8">
        @if (count($products) < $totalProducts)
            <button wire:click="showMore" type="button"
                class="text-white bg-[#A18A68] hover:bg-[#8C7A53] focus:ring-4 focus:ring-[#8C7A53] transition-all duration-300 transform hover:scale-80 font-medium rounded-lg text-lg px-6 py-1 mb-4 shadow-lg hover:shadow-2xl focus:outline-none">
                Show More
            </button>
        @endif

        @if ($limit > 8)
            <button wire:click="showLess" type="button"
                class="text-white bg-gray-700 hover:bg-[#A18A68] focus:ring-4 focus:ring-[#8C7A53] transition-all duration-300 transform hover:scale-80 font-medium rounded-lg text-lg px-6 py-1 mb-4 shadow-lg hover:shadow-2xl focus:outline-none">
                Show Less
            </button>
        @endif
    </div>
</div>