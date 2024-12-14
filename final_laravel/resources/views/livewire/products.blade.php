<section class="grid h-full phone:grid-cols-2 phone:max-tablet:justify-center tablet:grid-cols-2 laptop:grid-cols-3 tablet:w-[calc(1200px-650px)] laptop:w-[calc(1200px-350px)] phone:w-[calc(500px-70px)] border-l border-gray-600 pl-9 phone:max-tablet:border-hidden">
    @foreach ($products as $item)
        <div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
            <a href="{{ route('detail', $item) }}">
                <div class="phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
                    <img src="{{ $item->images->first()->first_url ?? '/path/to/fallback-image.jpg' }}" alt="{{ $item->name }}"
                        class="w-full h-full object-cover">
                    <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">
                        {{ $item->name }}
                    </h3>
                    <h4 class="text-center font-garamond phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
                        @if ($item->highest_sale)
                            <font color="red">{{ $item->highest_sale }}% Off</font><br>
                            <font color="#a28b68">
                                <s>${{ number_format($item->price, 2) }}</s> ${{ number_format($item->price * (1 - $item->highest_sale / 100), 2) }}
                            </font>
                        @else
                            ${{ number_format($item->price, 2) }}
                        @endif
                    </h4>
                </div>
            </a>
        </div>
    @endforeach
</section>