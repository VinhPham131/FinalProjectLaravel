<div class="container mx-auto p-6 tablet:max-w-[1200px] tablet:mx-auto">
    <h1 class="text-3xl font-semibold mb-6">Shopping Cart</h1>
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4">Add items</th>
                    <th class="p-4">Products</th>
                    <th class="p-4">Material</th>
                    <th class="p-4">Size</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Quantity</th>
                    <th class="p-4">Total</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                    <tr class="border-b">
                        <td class="p-4">
                            <img src="{{ $item->product->images->first()->first_url }}" alt="{{ $item->product->name }}" class="w-16 h-16">
                        </td>
                        <td class="p-4">
                            <p class="font-semibold">{{ $item->product->name }}</p>
                            <p class="text-gray-500">Style: {{ $item->product->stylecode }}</p>
                        </td>
                        <td class="p-4">{{ $item->product->material }}</td>
                        <td class="p-4">{{ $item->product->size }}</td>
                        <td class="p-4">${{ number_format($item->product->salePrice(), 2) }}</td>
                        <td class="p-4">
                            <div class="flex items-center">
                                <button wire:click="updateQuantity({{ $item->product->id }}, 'decrease')" class="border px-2 py-1">-</button>
                                <span class="mx-2">{{ $item->quantity }}</span>
                                <button wire:click="updateQuantity({{ $item->product->id }}, 'increase')" class="border px-2 py-1">+</button>
                            </div>
                        </td>
                        <td class="p-4">${{ number_format($item->product->salePrice() * $item->quantity, 2) }}</td>
                        <td class="p-4">
                            <button wire:click="removeFromCart({{ $item->product->id }})" class="text-red-500 text-xs hover:underline">
                                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Trash Bin Icon" class="w-4 h-4" style="filter: invert(18%) sepia(100%) saturate(7483%) hue-rotate(1deg) brightness(97%) contrast(119%);">
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center">Your cart is empty.</td>
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