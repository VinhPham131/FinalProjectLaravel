<div class="relative">
    <!-- Cart Icon with Dropdown -->
    <button id="dropdownCartButton" data-dropdown-toggle="dropdownCart"
        class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/324b097b3a26f24da080c52561d900b13bf05f0d28848eed44fbb39ad816c1d1"
            alt="Cart Icon" class="w-6 h-6">
        @if (count($cart) > 0)
            <span
                class="absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-2">
                {{ count($cart) }}
            </span>
        @endif
    </button>

    <!-- Cart Dropdown -->
    <div id="dropdownCart" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-[350px]">

        <ul class="divide-y divide-gray-100">
            @forelse ($cart as $id => $item)
                <li class="flex items-center p-2">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-[100px] h-[100px] mr-3">
                    <div class="flex-1">
                        <div class="text-sm font-medium">{{ $item['name'] }}</div>
                        <div class="text-[15px] text-gray-500">
                            <font color="#a28b68">${{ number_format($item['price'], 2) }}</font>
                        </div>
                        <div class="flex space-x-2 mt-1">
                            <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                class="text-gray-700 text-xs px-2 border rounded">-</button>
                            <div class="text-gray-700 text-xs">{{ $item['quantity'] }}</div>
                            <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                class="text-gray-700 text-xs px-2 border rounded">+</button>
                        </div>

                    </div>
                    <button wire:click="removeFromCart({{ $id }})" class="text-red-500 text-xs hover:underline">
                        <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Trash Bin Icon" class="w-4 h-4" style="filter: invert(18%) sepia(100%) saturate(7483%) hue-rotate(1deg) brightness(97%) contrast(119%);">
                    </button>


                </li>
            @empty
                <li class="p-2 text-sm text-gray-500">Your cart is empty.</li>
            @endforelse
        </ul>
        <div class="p-4">
            <div class="font-bold text-sm mb-2">Total: ${{ number_format($total, 2) }}</div>
            <a href="#" class="block w-full text-center text-white bg-gray-800  hover:bg-gray-900 px-4 py-2 rounded-md">
                Checkout
            </a>
        </div>
    </div>
</div>