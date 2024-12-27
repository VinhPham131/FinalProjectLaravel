<form  method="POST" action="{{ route('checkout.process', ['step' => $step + 1]) }}">
    @csrf
    <section class="relative h-screen flex justify-center items-center mt-10 bg-slate-50 dark:bg-slate-800">
    <div  class="container relative">
        <div  class="md:flex justify-center">
            <div class="lg:w-2/5">
                <div class="relative overflow-hidden rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800">
                    <!-- Payment Header -->
                    <div class="px-6 py-12 bg-emerald-600 text-center">
                        <i class="mdi mdi-check-circle text-white text-6xl"></i>
                        <h5 class="text-white text-xl tracking-wide uppercase font-semibold mt-2">Payment Successful</h5>
                    </div>

                    <!-- Content Section -->
                    <div class="px-6 py-12 text-center">
                        <p class="text-black font-semibold text-xl dark:text-white">Thank you for your payment! 🎉</p>
                        <p class="text-slate-400 mt-4">
                            Your payment has been processed successfully. <br />
                            Enjoy your trip. Thank you for choosing Tripser!
                        </p>

                        <div class="mt-6">
                            <a href="{{ url('/') }}" class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-black text-white rounded-md">
                                Go to Home
                            </a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center p-6 border-t border-gray-100 dark:border-gray-700">
                        <p class="mb-0 text-slate-400">
                            © {{ now()->year }} Tripser. Travel & Booking Tour 
                            <i class="mdi mdi-heart text-red-600"></i> by 
                            <a href="https://www.facebook.com/people/Vinh-Ph%E1%BA%A1m/pfbid017G65KvCaYQSTU9oiog147nAHVyXmQYqi8pjM9iPVbE3g6uA94PmDWue7wzUSkQpl/" 
                               target="_blank" 
                               class="text-reset">
                                Vinh Pham
                            </a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    
</form>
