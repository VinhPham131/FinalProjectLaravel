<div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px] transition-transform transform hover:scale-105">
    <a href="{{ route('detail', $product) }}" class="block relative group">
        <div class="phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px] overflow-hidden">
            <img src="{{ $product->getPrimaryImagePath() }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover transition-transform transform group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="text-white text-lg font-bold">View Details</span>
            </div>
        </div>
        <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">
            {{ $product->name }}
        </h3>
        <h4 class="text-center font-garamond phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
            @if ($product->highest_sale_percentage)
                <span class="text-red-500">{{ number_format($product->highest_sale_percentage, 2) }}% Off</span><br>
                <span class="text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                <span class="text-green-500">${{ number_format($product->salePrice(), 2) }}</span>
            @else
                <span class="text-gray-800">${{ number_format($product->price, 2) }}</span>
            @endif
        </h4>
        <h5 class="text-center font-garamond phone:text-[11px] tablet:text-[15px] desktop:text-[15px] mt-2">
            @if ($product->quantity > 0)
                <span class="text-green-500">In Stock</span>
            @else
                <span class="text-red-500">Not in Stock</span>
            @endif
        </h5>
    </a>
</div>