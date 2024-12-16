<section>
    <section
        class="grid h-full phone:grid-cols-2 phone:max-tablet:justify-center tablet:grid-cols-2 laptop:grid-cols-3 tablet:w-[calc(1200px-650px)] laptop:w-[calc(1200px-350px)] phone:w-[calc(500px-70px)]  phone:max-tablet:border-hidden">
        @forelse ($products as $item)
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
                                    ${{ number_format($item->salePrice(), 2) }}
                                </font>
                            @else
                                <font color="#a28b68">${{ number_format($item->price, 2) }}</font>
                            @endif
                        </h4>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                No products found.
            </div>
        @endforelse

        <!-- Pagination Controls -->

    </section>
    <div class="ml-[350px] mt-4">
        {{ $products->links('vendor.livewire.simple-tailwind') }} <!-- Livewire pagination links -->
    </div>
</section>