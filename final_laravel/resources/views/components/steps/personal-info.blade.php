<form method="POST" action="{{ route('checkout.process', ['step' => 1]) }}">
    @csrf
    <div class="max-w-6xl mx-auto py-12 px-8 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-200 shadow-xl rounded-lg mt-[30px]">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-[100px]">
            
            <!-- Billing Details Form -->
            <div class="space-y-6">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Personal Information</h2>
                <form id="billingForm" class="space-y-6">
                    <!-- First Name and Last Name -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="firstName" class="block text-sm font-bold text-gray-700">First Name *</label>
                            <input type="text" id="first_name" name="first_name"
                                class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]" required>
                            <span class="text-red-500 text-sm hidden" id="firstNameError">This field is required.</span>
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-bold text-gray-700">Last Name *</label>
                            <input type="text" id="last_name" name="last_name"
                                class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]" required>
                            <span class="text-red-500 text-sm hidden" id="lastNameError">This field is required.</span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700">Email *</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]" required>
                        <span class="text-red-500 text-sm hidden" id="emailError">Please enter a valid email address.</span>
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-bold text-gray-700">Country *</label>
                        <select id="country" name="country"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]" required>
                            <option value="">Select your country</option>
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Việt Nam</option>
                            <option>Other</option>
                        </select>
                        <span class="text-red-500 text-sm hidden" id="countryError">Please select your country.</span>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-bold text-gray-700">Street Address *</label>
                        <input type="text" id="address" name="address"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]" required>
                        <span class="text-red-500 text-sm hidden" id="addressError">This field is required.</span>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-700">Phone *</label>
                        <input type="text" id="phone" name="phone"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]" required>
                        <span class="text-red-500 text-sm hidden" id="phoneError">This field is required.</span>
                    </div>

                    <!-- Order Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-bold text-gray-700">Order Notes</label>
                        <textarea id="notes" name="note" rows="4"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#A18A68]"></textarea>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="bg-white p-8 shadow-2xl rounded-lg space-y-8">
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Your Order</h2>
                <div class="space-y-4">
                    <div class="flex justify-between text-lg font-semibold text-gray-700">
                        <span>Product</span>
                        <span>Total</span>
                    </div>
                    <div class="border-t pt-6 space-y-4">
                        @foreach ($cart as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                <span class="border border-[#A18A68] px-3 py-1 rounded-full font-medium text-[#A18A68]">x {{ $item['quantity'] }}</span>
                                    <span class="font-semibold text-gray-800 w-[250px]">{{ $item['name'] }}</span>
                                </div>
                                <span class="text-[#A18A68] font-semibold">${{ number_format($item['total'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t pt-6">
                        <div class="flex justify-between font-medium text-gray-600">
                            <span>Subtotal</span>
                            <span class="text-[#A18A68] font-semibold">${{ number_format($totalPrice, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-medium text-gray-600">
                            <span>Shipping</span>
                            <span class="text-[#A18A68]">Free Shipping</span>
                        </div>
                    </div>
                    <div class="border-t pt-6">
                        <div class="flex justify-between text-xl font-semibold text-gray-800">
                            <span>Total</span>
                            <span class="text-[#A18A68] font-bold">${{ number_format($totalPrice, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Options -->
                <div class="mt-6 space-y-6">
                    <span class="text-gray-800 font-semibold">Payment Method</span>

                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment" value="Bank Transfer"
                            class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                        <span class="ml-2 text-gray-700">Bank Transfer</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment" value="COD"
                            class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                        <span class="ml-2 text-gray-700">Cash on Delivery</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment" value="Paypal"
                            class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                        <span class="ml-2 text-gray-700">PayPal</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full mt-8 py-4 px-10 bg-[#A18A68] text-white text-xl font-semibold rounded-lg transition-transform transform hover:scale-105 duration-300">
                    Proceed to Confirmation
                </button>
            </div>
        </div>
    </div>
</form>
