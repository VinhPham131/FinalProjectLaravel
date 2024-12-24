<section class="grid justify-items-center">
    <footer
        class="border-t-2 mt-60 phone:max-tablet:mb-10 phone:max-tablet:border-b-0 tablet:mx-[200px] tablet:max-w-[1200px] phone:mx-[10px] tablet:w-[calc(1200px-350px)] laptop:w-[calc(1200px-100px)]">
        <section class="grid justify-between mx-10 phone:max-tablet:grid-cols-1 tablet:grid-cols-2">
            <!-- Logo và Links Section -->
            <div class="flex flex-col gap-5 mt-10 phone:max-tablet:items-start tablet:items-start">
                <!-- Logo -->
                <a href="/" class="mb-5">
                    <div class="text-4xl leading-10 text-stone-950">
                        <font color="#a28b68">L</font><span class="text-neutral-950">B</span><span
                            class="text-stone-950">J</span>
                    </div>
                </a>
                <!-- Links -->
                <div class="flex flex-col gap-3">
                    <a href="" class="text-gray-500">CONTACT</a>
                    <a href="" class="text-gray-500">TERMS OF SERVICES</a>
                    <a href="" class="text-gray-500">SHIPPING AND RETURNS</a>
                </div>
            </div>

            <!-- Form Section -->
            <div class="grid justify-items-center w-full mt-10">
                <div class="flex flex-col justify-center mb-2 w-full max-w-[600px] ml-30">
                    <!-- Title -->
                    <h2 class="text-xl font-garamond mb-4">Contact with LBJ:</h2>
                    <form wire:submit.prevent="submitContactForm" class="flex flex-col gap-3">
                        @csrf
                        <div class="flex flex-wrap gap-3">
                            <!-- Left Side Inputs -->
                            <div class="flex flex-col w-[48%] gap-3">
                                <input type="text" wire:model="name" placeholder="Your Name"
                                    class="border-2 border-black p-2 w-full" required>
                                <input type="email" wire:model="email" placeholder="Your Email"
                                    class="border-2 border-black p-2 w-full" required>
                            </div>
                            <div class="w-[48%] flex items-stretch">
                                <textarea wire:model="message" placeholder="Your Message"
                                    class=" border-2 border-black p-2 w-full h-[98px] resize-none" required></textarea>
                            </div>
                        </div>
                        <!-- Full Width Submit Button -->
                        <button type="submit" class="bg-[#a28b68] text-white py-2 px-4 hover:bg-opacity-90 w-full mt-4">
                                    class=" border-2 border-black p-2 w-full h-[98px] resize-none"
                                    required></textarea>
                            </div>
                        </div>
                        <!-- Full Width Submit Button -->
                        <button type="submit"
                            class="bg-[#a28b68] text-white py-2 px-4 hover:bg-opacity-90 w-full mt-4">
                            Send Message
                        </button>
                        @if (session()->has('success'))
                            <div class="text-white font-bold mt-2">{{ session('success') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </section>

        <section class="phone:grid-rows-1 phone:grid tablet:flex justify-between mx-10 my-10 mt-[10px]">
            <div>
                © 2024 LBJ.
                <a href="#" class="text-gray-500">Terms of use</a>
                and
                <a href="#" class="text-gray-500">Privacy Policy</a>
            </div>
        </section>
    </footer>
</section>