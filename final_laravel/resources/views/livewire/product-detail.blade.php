<section>
    <!-- Product Details Section -->
    <section class="product-details grid grid-cols-1 laptop:grid-cols-2 gap-10 max-w-[1200px] mx-auto laptop:mt-5">
        <!-- Left Column: Product Images -->
        <section class="slideshow-container relative">
            <section class="relative border-2 border-gray-700 tablet:w-[605px] tablet:h-[555px] mt-5">
                @foreach ($product->images as $image)
                    @foreach ($image->urls as $index => $url)
                        <section class="mySlides fade hidden" data-slide="{{ $index }}">
                            <img src="{{ $url }}" class="w-[600px] h-[550px] phone:max-tablet:w-full phone:max-tablet:h-full"
                                alt="Image {{ $index + 1 }}">
                        </section>
                    @endforeach
                @endforeach

                <!-- Navigation Buttons -->
                <a class="prev cursor-pointer absolute top-1/2 transform -translate-y-1/2 left-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-r-md select-none"
                    onclick="changeSlide(-1)">&#10094;</a>
                <a class="next cursor-pointer absolute top-1/2 transform -translate-y-1/2 right-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-l-md select-none"
                    onclick="changeSlide(1)">&#10095;</a>
            </section>
            <section class="justify-center flex gap-6 phone:mb-10 mt-5 ml-5">
                @foreach ($product->images as $image)
                    @foreach ($image->urls as $index => $url)
                        <img src="{{ $url }}" alt="Thumbnail {{ $index + 1 }}"
                            class="thumbnail w-[100px] h-[100px] object-cover opacity-40 hover:opacity-100 hover:border hover:border-gray-700"
                            data-slide="{{ $index }}" onclick="showSlide({{ $index }})">
                    @endforeach
                @endforeach
            </section>

        </section>

        <!-- Right Column: Product Info -->
        <section class="product-info new-product-info ml-7 max-w-[450px]">
            <h1 class="font-garamond font-bold text-[25px] mt-7">{{ $product->name }}</h1>
            <section class="flex justify-center items-center text-sm mt-4 border-b border-grey-600 pb-4 mb-6">
                @if ($product->highest_sale)
                    <b class="bg-a28b68 text-white px-2.5 py-1 font-bold mx-1.5">
                        ${{ number_format($product->discounted_price, 2) }}
                    </b>
                    <del class="mx-1.5 text-a28b68">${{ number_format($product->price, 2) }}</del>
                    <span class="bg-red-800 text-white px-2.5 py-1 font-medium mx-1.5">
                        -{{ $product->highest_sale }}%
                    </span>
                @else
                    <b class="bg-gray-800 text-white px-2.5 py-1 font-bold mx-1.5">
                        ${{ number_format($product->price, 2) }}
                    </b>
                @endif
            </section>

            <p class="tracking-wide font-garamond text-lg mb-7">
                <label class="block font-bold">Material</label>
                <span class="block border p-2 text-center text-[15px] ">{{ $product->material }}</span>
            </p>
            <p class="tracking-wide font-garamond text-lg mb-7">
                <label class="block font-bold">Size</label>
                <span class="block border p-2 text-center text-[15px]">{{ $product->size ?? 'N/A' }}</span>
            </p>
            <p class="tracking-wide font-garamond text-lg mb-12">
                <label class="block font-bold">Stylecode</label>
                <span class="block border p-2 text-center text-[15px]">{{ $product->stylecode ?? 'N/A' }}</span>
            </p>

            <!-- Add to Cart button -->
            <button wire:click="addToCart"
                class="w-full bg-gray-800 text-white flex justify-center items-center h-11 max-w-[470px] hover:bg-gray-900 transition">
                Add to Cart
            </button>

        </section>
    </section>
    <section>
        <h3 class="font-garamond cursor-pointer font-bold text-2xl pb-3.75 max-[431px]:mx-5">
            <a class="border-b-2 border-yellow-700 my-3">Product Information</a>
        </h3>
        <section class="new-container max-w-[1200px] max-[431px]:mx-10">
            <p class="tracking-wide font-garamond mt-8 mb-3 leading-5 text-[20px] max-w-[1200px]">
                {{ $product->description }}
            </p>
            <p class="tracking-wide font-garamond mt-2.5 text-[20px] mb-5">
                <span style="font-weight: bold;">Collection:</span> {{ $product->collection->name }}<br>
                <span style="font-weight: bold;">Product Code:</span> {{ $product->productcode }}<br>
                <span style="font-weight: bold;">Classification:</span> {{ $product->category->name ?? 'N/A' }}<br>
                <span style="font-weight: bold;">Material:</span> {{ $product->material }}<br>
                <span style="font-weight: bold;">Color:</span> {{ $product->color }}
            </p>
        </section>
    </section>


    <!-- Related Products Section -->
    <section class="related-products mt-10">
        <h3 class="font-garamond font-bold text-2xl pb-3.75">
            <a class="border-b-2 border-yellow-700">Related Products</a>
        </h3>
        <div>
            <section
                class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] px-4">
                @foreach ($relatedProducts  as $item)
                    <div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
                        <a href="{{ route('detail', $item) }}">
                            <div class="phone:h-[180px] phone:w-[180px] tablet:w-[240px] tablet:h-[240px]">
                                <img src="{{ $item->images->first()->first_url ?? '/path/to/fallback-image.jpg' }}"
                                    alt="{{ $item->name }}" class="w-full h-full object-cover">
                                <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">
                                    {{ $item->name }}
                                </h3>
                                <h4
                                    class="text-center font-garamond phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
                                    @if ($item->highest_sale)
                                        <font color="red">{{ $item->highest_sale }}% Off</font><br>
                                        <font color="#a28b68">
                                            <s>${{ number_format($item->price, 2) }}</s>
                                            ${{ number_format($item->discounted_price, 2) }}
                                        </font>
                                    @else
                                        <font color="#a28b68">${{ number_format($item->price, 2) }}</font>
                                    @endif
                                </h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </section>
        </div>
    </section>

</section>