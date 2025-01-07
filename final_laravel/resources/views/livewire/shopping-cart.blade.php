<div x-data x-on:cart-updated-global.window="$wire.loadCart()" class="container mx-auto px-4 py-8">
    @if (empty($cartItem))
        <!-- Empty Cart Message -->
        <div class="bg-gray-50 p-6 rounded-lg shadow text-center">
            <p class="text-lg text-gray-600">Your cart is empty.</p>
        </div>
    @else
        <!-- Cart Table -->
        <div class="overflow-x-auto border rounded-lg shadow-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 uppercase text-sm">
                        <th class="p-4"></th>
                        <th class="p-4">Products</th>
                        <th class="p-4">Material</th>
                        <th class="p-4">Size</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Quantity</th>
                        <th class="p-4">Total</th>
                        <th class="p-6"></th>
                    </tr>
                </thead>
                <tbody class="text-center divide-y divide-gray-200">
                    @foreach ($cartItem as $id => $item)
                        <tr>
                            <td class=""><img src="{{ $item['image'] }}" class="w-[150px] h-[150px]"></td>
                            <td class="p-4">{{ $item['name'] }}</td>
                            <td class="p-4">{{ $item['material'] }}</td>
                            <td class="p-4">{{ $item['size'] }}</td>
                            <td class="p-4">
                                @if ($item['discount_percentage'] > 0)
                                    <span class="text-a28b68 font-bold">${{ number_format($item['price'], 2) }}</span>
                                    <span class="line-through text-gray-500">${{ number_format($item['original_price'], 2) }}</span>
                                @else
                                    <span class="text-a28b68 font-bold">${{ number_format($item['original_price'], 2) }}</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <button wire:click="updateQuantity({{ $id }}, 'decrease')">-</button>
                                <span class="border-2 px-1 border-gray-300 rounded-md">{{ $item['quantity'] }}</span>
                                <button wire:click="updateQuantity({{ $id }}, 'increase')">+</button>
                            </td>
                            <td class="p-4">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="p-4">
                                <button wire:click="removeFromCart({{ $id }})" class="text-red-500 text-xs hover:underline">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Trash Bin Icon"
                                        class="w-4 h-4"
                                        style="filter: invert(18%) sepia(100%) saturate(7483%) hue-rotate(1deg) brightness(97%) contrast(119%);">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total and Checkout -->
        <div class="flex justify-end mt-6">
            <div class="w-1/3 bg-gray-50 p-4 rounded-lg shadow">
                <div class="flex justify-between text-lg font-semibold">
                    <span>TOTAL</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <button class="mt-4 w-full bg-black text-white py-3 rounded-md hover:bg-gray-800"
                    onclick="window.location.href='{{ route('checkout.step', ['step' => 1]) }}'">
                    PROCEED TO CHECKOUT
                </button>
            </div>
        </div>
    @endif
</div>
