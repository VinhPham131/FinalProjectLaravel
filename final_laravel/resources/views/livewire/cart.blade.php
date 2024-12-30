<div x-data="{ 
    openDropdown: false, 
    notification: '', 
    showNotification: false,
    triggerNotification(event) {
        console.log('Event Detail:', event.detail);
        if (event.detail && event.detail.message) {
            this.notification = event.detail.message;
        } else {
            this.notification = 'No message provided';
        }
        this.showNotification = true;
        setTimeout(() => this.showNotification = false, 3000); 
    }
}" 
x-on:cart-updated-global.window="$wire.loadCart()" 
x-on:cart-updated.window="triggerNotification($event)"
 class="relative">
    <!-- Thông báo -->
    <div x-show="showNotification" x-transition
        class="fixed top-[100px] right-[200px] bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
        <span x-text="notification"></span>
    </div>


    <!-- Cart Icon with Dropdown -->
    <button @click="openDropdown = !openDropdown" @mouseover="openDropdown = true" @mouseleave="openDropdown = false"
        id="dropdownCartButton"
        class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/324b097b3a26f24da080c52561d900b13bf05f0d28848eed44fbb39ad816c1d1"
            alt="Cart Icon" class="w-6 h-6">
        @if ($totalQuantity > 0)
            <span
                class="absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-2">
                {{ $totalQuantity }}
            </span>
        @endif
    </button>

    <!-- Cart Dropdown -->
    <div x-show="openDropdown" @mouseenter="openDropdown = true" @mouseleave="openDropdown = false"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
        id="dropdownCart"
        class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-[350px] absolute top-10 right-0 ml-2">
        <ul class="divide-y divide-gray-100">
            @forelse ($cartItem as $id => $item)
                <li class="flex items-center p-2">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-[100px] h-[100px] mr-3">
                    <div class="flex-1">
                        <div class="text-sm font-medium">{{ $item['name'] }}</div>
                        <div class="text-[15px] text-red-700">
                            <span class="text-a28b68 font-bold">
                                ${{ number_format($item['price'], 2) }}
                            </span>
                            @if ($item['discount_percentage'] > 0)
                                <span class="line-through text-gray-500 ">
                                    ${{ number_format($item['original_price'], 2) }}
                                </span>
                                <span class="text-red-500 text-xs ml-3">
                                    ({{ $item['discount_percentage'] }}% OFF)
                                </span>
                            @endif
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
                        <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Trash Bin Icon"
                            class="w-4 h-4"
                            style="filter: invert(18%) sepia(100%) saturate(7483%) hue-rotate(1deg) brightness(97%) contrast(119%);">
                    </button>
                </li>
            @empty
                <li class="p-2 text-md text-gray-500 ml-2">Your cart is empty.</li>
            @endforelse
        </ul>
        <div class="p-4">
            <div class="flex justify-between items-center">
                <div class="text-a28b68 font-bold text-md mb-2">Total: ${{ number_format($total, 2) }}</div>
                <a class = "text-gray-500 hover:underline cursor-pointer" href="{{ route('cart.index') }}">
                    <span class="text-gray-500 mb-4">View all</span>
                </a>
            </div>
            <a href="{{ route('checkout.step', ['step' => 1]) }}" class="block w-full text-center text-white bg-gray-800 hover:bg-gray-900 px-4 py-2 rounded-md">
                Checkout
            </a>
        </div>
    </div>
</div>