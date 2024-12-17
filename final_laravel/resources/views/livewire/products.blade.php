<div>
    <section class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] gap-4 px-4">
        @foreach ($products as $item)
            <div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
                <a href="{{ route('detail', $item) }}">
                    <div class="phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
                        <img src="{{ $item->images->first()->first_url ?? '/path/to/fallback-image.jpg' }}"
                            alt="{{ $item->name }}" class="w-full h-full object-cover">
                        <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">
                            {{ $item->name }}
                        </h3>
                        <h4 class="text-center font-garamond phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
                            @if ($item->highest_sale)
                                <font color="red">{{ $item->highest_sale }}% Off</font><br>
                                <font color="#a28b68">
                                    <s>${{ number_format($item->price, 2) }}</s>
                                    ${{ number_format($item->discounted_price, 2) }}
                                </font>
                            @else
                                <font color="#a28b68">${{ number_format($item->price, 2) }}</font>
                            @endif
                        </h4>
                    </div>
                </a>
            </div>
        @endforeach
    </section>

    <div class="text-center mt-8">
        @if (count($products) < $totalProducts)
            <button wire:click="showMore" type="button"
                class="text-white bg-[#A18A68] hover:bg-[#8C7A53] focus:ring-4 focus:ring-[#8C7A53] transition-all duration-300 transform hover:scale-80 font-medium rounded-lg text-lg px-6 py-3 mb-4 shadow-lg hover:shadow-2xl focus:outline-none">
                Show More
            </button>
        @endif

        @if ($limit > 8)
            <button wire:click="showLess" type="button"
                class="text-white bg-gray-700 hover:bg-[#A18A68] focus:ring-4 focus:ring-[#8C7A53] transition-all duration-300 transform hover:scale-80 font-medium rounded-lg text-lg px-6 py-3 mb-4 shadow-lg hover:shadow-2xl focus:outline-none">
                Show Less
            </button>
        @endif
    </div>
</div>



