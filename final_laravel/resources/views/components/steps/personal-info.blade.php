<form method="POST" action="{{ route('checkout.step', ['step' => $step + 1]) }}">
    @csrf
    <div class="max-w-6xl mx-auto py-12 flex justify-between gap-8 bg-slate-100  shadow-md p-10 my-10">
    <!-- Billing Details Form -->
    <div class="w-[700px]">
        <h2 class="text-2xl font-semibold mb-6">Billing Details</h2>
        <form id="billingForm" class="space-y-4">
            <!-- First Name and Last Name -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="firstName" class="block text-sm font-bold text-gray-700">First name *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"
                        required>
                    <span class="text-red-500 text-sm hidden" id="firstNameError">This field is required.</span>
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-bold text-gray-700">Last name *</label>
                    <input 
                        type="text" 
                        id="lastName" 
                        name="lastName" 
                        class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"
                        required>
                    <span class="text-red-500 text-sm hidden" id="lastNameError">This field is required.</span>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"
                    required>
                <span class="text-red-500 text-sm hidden" id="emailError">Please enter a valid email address.</span>
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-bold text-gray-700">Country *</label>
                <select 
                    id="country" 
                    name="country" 
                    class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"
                    required>
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
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"
                    required>
                <span class="text-red-500 text-sm hidden" id="addressError">This field is required.</span>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-bold text-gray-700">Phone *</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"
                    required>
                <span class="text-red-500 text-sm hidden" id="phoneError">This field is required.</span>
            </div>
            <!-- Additional Options -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox  border-gray-300 text-[#A18A68] focus:ring-2 focus:ring-[#A18A68]">
                    <span class="ml-2 text-sm text-gray-700">Create an account?</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox  border-gray-300 text-[#A18A68] focus:ring-2 focus:ring-[#A18A68]">
                    <span class="ml-2 text-sm text-gray-700">Ship to a different address?</span>
                </label>
            </div>

            <!-- Order Notes -->
            <div>
                <label for="notes" class="block text-sm font-bold text-gray-700">Order notes</label>
                <textarea id="notes" rows="4" class="w-full p-3 border border-gray-300  focus:ring-2 focus:ring-[#A18A68]"></textarea>
            </div>
        </form>
    </div>

    <!-- Order Summary -->
    <div>
        <h2 class="text-2xl font-semibold mb-6 w-[300px]">Your Order</h2>
        <div class="bg-gray-50 p-6 -lg shadow-md">
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span>PRODUCT</span>
                    <span>TOTAL</span>
                </div>
                <div class="border-t pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span>Lira Earrings</span>
                        <span>$64</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ollie Earrings</span>
                        <span>$10</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Kaede Hair Pin</span>
                        <span>$10</span>
                    </div>
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between">
                        <span>SUBTOTAL</span>
                        <span>$85</span>
                    </div>
                    <div class="flex justify-between">
                        <span>SHIPPING</span>
                        <span>Free shipping</span>
                    </div>
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between font-semibold">
                        <span>TOTAL</span>
                        <span>$85</span>
                    </div>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="mt-6 space-y-4">
                <label class="flex items-center">
                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                    <span class="ml-2 text-gray-700">Direct bank transfer</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                    <span class="ml-2 text-gray-700">Check payments</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                    <span class="ml-2 text-gray-700">Cash on delivery</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-[#A18A68] focus:ring-[#A18A68]">
                    <span class="ml-2 text-gray-700">PayPal</span>
                </label>
            </div>

            
    <button type="submit" class="bg-black text-white py-3 px-[120px] mt-10 text-center ">Next</button>
    </div>
    </div>
    </div>

    
</form>
