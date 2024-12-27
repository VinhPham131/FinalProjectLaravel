<form method="POST" action="{{ route('checkout.process', ['step' => $step + 1]) }}">
    @csrf
    <div class="max-w-6xl mx-auto py-12 flex justify-between gap-8 bg-slate-100  shadow-md p-10 my-10">
    <!-- Order Details -->
    <div class="space-y-6">
        <h2 class="text-2xl font-semibold mb-6 w-[300px]">Order Details</h2>
        <div class="space-y-3 text-base text-gray-700">
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-1/3">ORDER NUMBER:</span>
                <span class="text-gray-600">1879605573994</span>
            </div>
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-1/3">EMAIL:</span>
                <span class="text-gray-600">vitathemes@gmail.com</span>
            </div>
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-1/3">PAYMENT METHOD:</span>
                <span class="text-gray-600">Mastercard ************7865</span>
            </div>
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-1/3">ORDER DATE:</span>
                <span class="text-gray-600">October 8, 2020</span>
            </div>
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-1/3">DELIVERY OPTIONS:</span>
                <span class="text-gray-600">Standard delivery</span>
            </div>
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-60">DELIVERY ADDRESS:</span>
                <span class="text-gray-600 w-120 leading-relaxed">
                    Kristian Holst, 34 Old Street, W1F 7NU, London, United Kingdom
                </span>
            </div>
            <div class="flex items-start">
                <span class="font-medium text-gray-800 w-1/3">CONTACT NUMBER:</span>
                <span class="text-gray-600">+44 8749790988</span>
            </div>
        </div>
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



    <div class="mt-6 text-right">
        <button type="submit" class="bg-black text-white py-3 px-[120px] hover:bg-black">Next</button>
    </div>
</div>
</div>
</div>
</div>
</form>
