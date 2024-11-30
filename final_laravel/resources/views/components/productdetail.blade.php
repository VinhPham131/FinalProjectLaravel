<div>
<div class="grid grid-cols-1 laptop:grid-cols-2 gap-10 max-w-[1200px] mx-auto laptop:mt-5">
        <!-- Left Column: Slideshow and Thumbnails -->
        <div class="slideshow-container relative">
            <!-- Slideshow -->
            <div class="relative border-2 border-gray-700 tablet:w-[605px] tablet:h-[555px] mt-5">
                @foreach ($product->images as $image)
                    @foreach ($image->urls as $index => $url)
                        <div class="mySlides fade hidden" data-slide="{{ $index }}">
                            <img src="{{ $url }}" class="w-[600px] h-[550px] phone:max-tablet:w-full phone:max-tablet:h-full"
                                alt="Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                @endforeach

                <!-- Navigation Buttons -->
                <a class="prev cursor-pointer absolute top-1/2 transform -translate-y-1/2 left-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-r-md select-none"
                    onclick="changeSlide(-1)">&#10094;</a>
                <a class="next cursor-pointer absolute top-1/2 transform -translate-y-1/2 right-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-l-md select-none"
                    onclick="changeSlide(1)">&#10095;</a>
            </div>

            <!-- Thumbnails -->
            <div class="justify-center flex gap-6 phone:mb-10 mt-5 ml-5">
                @foreach ($product->images as $image)
                    @foreach ($image->urls as $index => $url)
                        <img src="{{ $url }}" alt="Thumbnail {{ $index + 1 }}"
                            class="thumbnail w-[100px] h-[100px] object-cover opacity-40 hover:opacity-100 hover:border hover:border-gray-700"
                            data-slide="{{ $index }}" onclick="showSlide({{ $index }})">
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Right Column: Product Info -->
        <div class="new-product-info ml-7 max-w-[450px]">
            <h1 class="font-garamond new-product-title font-bold text-[25px] mt-7">{{ $product->name }}
            </h1>
            <div
                class="new-product-info-prices flex justify-center items-center text-sm mt-4 border-b border-grey-600 pb-4 max-w-[450px] mb-6">
                @if ($product->highest_sale)
                    <b class="bg-a28b68 text-white inline-block px-2.5 py-1 font-bold mx-1.5">
                        ${{ number_format($product->discounted_price, 2) }}
                    </b>
                    <del class="mx-1.5 text-a28b68">${{ number_format($product->price, 2) }}</del>
                    <span class="bg-red-800 text-white inline-block px-2.5 py-1 font-medium mx-1.5">
                        -{{ $product->highest_sale }}%
                    </span>
                @else
                    <b class="bg-gray-800 text-white inline-block px-2.5 py-1 font-bold mx-1.5">
                        ${{ number_format($product->price, 2) }}
                    </b>
                @endif
            </div>

            <!-- Product Details -->
            <div class="mt-4 max-w-[450px]">
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
            </div>

            <!-- Add to Cart button -->
            <div class="new-product-action mt-6">
                <button id="addcart"
                    class="w-full bg-gray-800 text-white flex justify-center items-center h-11 max-w-[470px]">
                    Add to cart
                </button>
            </div>
        </div>

    </div>

    <!-- Product Description -->
    <h3 class="font-garamond cursor-pointer font-bold text-2xl pb-3.75 max-[431 px]:mx-5">
        <a class="border-b-2 border-yellow-700 my-3">Product Information</a>
    </h3>
    <div class="new-container  max-w-[1200px] max-[431px]:mx-10">
        <p class="tracking-wide font-garamond mt-8 mb-3 leading-5 text-[20px] max-w-[1200px]">
            {{ $product->description }}
        </p>
        <p class="tracking-wide font-garamond mt-2.5 text-[20px] mb-5">
            Collection: {{ $product->collection->name }}<br>
            Product Code: {{ $product->productcode }}<br>
            Classification: {{ $product->category->name ?? 'N/A' }}<br>
            Material: {{ $product->material }}<br>
            Color: {{ $product->color }}
        </p>
    </div>
</div>