<div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
    <a href="{{ route('detail', $product) }}">
        <div class="phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
            <img src="{{ $product->getPrimaryImagePath() }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover">
            <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">
                {{ $product->name }}
            </h3>
            <h4 class="text-center font-garamond phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
                @if ($product->highest_sale_percentage)
                    <font color="red">{{ number_format($product->highest_sale_percentage, 2) }}% Off</font><br>
                    <font color="#a28b68">
                        <s>${{ number_format($product->price, 2) }}</s>
                        ${{ number_format($product->salePrice(), 2) }}
                    </font>
                @else
                    <font color="#a28b68">${{ number_format($product->price, 2) }}</font>
                @endif
            </h4>
        </div>
    </a>
</div>