<form method="POST" action="{{ route('checkout.process', ['step' => 2]) }}">
    @csrf
    <div class="max-w-[1200px] mx-auto py-12 px-8 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-200 shadow-xl rounded-lg mt-[30px]">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Order Details Sidebar -->
            <div class="space-y-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Order Details</h2>
                <div class="space-y-6 text-lg text-gray-600">
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Name:</span>
                        <span class="text-gray-800">{{ session('checkout.first_name') }} {{ session('checkout.last_name') }}</span>
                    </div>
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Email:</span>
                        <span class="text-gray-800">{{ session('checkout.email') }}</span>
                    </div>
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Country:</span>
                        <span class="text-gray-800">{{ session('checkout.country') }}</span>
                    </div>
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Address:</span>
                        <span class="text-gray-800">{{ session('checkout.address') }}</span>
                    </div>
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Phone:</span>
                        <span class="text-gray-800">{{ session('checkout.phone') }}</span>
                    </div>
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Shipping:</span>
                        <span class="text-[#A18A68] font-semibold">Free Shipping</span>
                    </div>
                    <div class="flex items-start space-x-4">
                        <span class="font-semibold text-gray-700 w-40">Note:</span>
                        <span class="text-gray-800">{{ session('checkout.note') }}</span>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white p-10 rounded-lg shadow-2xl space-y-8">
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Your Order</h2>
                <div class="flex justify-between text-lg font-semibold  text-gray-700">
                    <span>Product</span>
                    <span>Total</span>
                </div>
                <div class="border-t pt-6 space-y-4">
                    @foreach ($cart as $item)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="border border-[#A18A68] px-3 py-1 rounded-full font-medium text-[#A18A68]">x {{ $item['quantity'] }}</span>
                                <span class="font-semibold text-gray-800 w-[220px]">{{ $item['name'] }}</span>
                            </div>
                            <span class="text-[#A18A68] font-semibold">${{ number_format($item['total'], 2) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t pt-6">
                    <div class="flex justify-between font-medium text-gray-700">
                        <span>Subtotal</span>
                        <span class="text-[#A18A68] font-semibold">${{ number_format($totalPrice, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-medium text-gray-700">
                        <span>Shipping</span>
                        <span class="text-[#A18A68]">Free Shipping</span>
                    </div>
                </div>
                <div class="border-t pt-6">
                    <div class="flex justify-between text-xl font-semibold text-gray-900">
                        <span>Total</span>
                        <span class="text-[#A18A68] font-bold">${{ number_format($totalPrice, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-medium text-gray-700">
                        <span>Payment Method</span>
                        <span class="text-gray-800">{{ session('checkout.payment') }}</span>
                    </div>
                </div>

                <!-- Payment Button -->
                <button type="submit" class="w-full mt-8 py-4 px-10 bg-[#A18A68] text-white text-xl font-semibold rounded-full shadow-lg transform hover:scale-105 duration-300 transition ease-in-out">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>
</form>

