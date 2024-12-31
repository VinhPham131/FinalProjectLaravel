<div class="container mx-auto p-6 tablet:max-w-[1150px] tablet:mx-auto">
    <h1 class="text-3xl font-semibold mb-6">Shopping Cart</h1>
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4"></th>
                    <th class="p-4">Products</th>
                    <th class="p-4">Material</th>
                    <th class="p-4">Size</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Quantity</th>
                    <th class="p-4">Total</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($cartItem as $id => $item)
                    <tr>
                        <td class="p-4"><img src="{{ $item['image'] }}" class="w-24 h-24"></td>
                        <td class="p-4">{{ $item['name'] }}</td>
                        <td class="p-4">{{ $item['material'] }}</td>
                        <td class="p-4">{{ $item['size'] }}</td>
                        <td class="p-4 ">${{ number_format($item['price'], 2) }}</td>
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
                @empty
                    <tr>
                        <td colspan="8">Your cart is empty.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-6">
        <div class="w-1/3">
            <div class="flex justify-between text-lg font-semibold">
                <span>TOTAL</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <button class="mt-4 w-full bg-black text-white py-3">PROCEED TO CHECKOUT</button>
        </div>
    </div>
</div>