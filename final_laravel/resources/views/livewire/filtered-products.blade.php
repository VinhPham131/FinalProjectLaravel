<section>
    <section
        class="grid h-full phone:grid-cols-2 phone:max-tablet:justify-center tablet:grid-cols-2 laptop:grid-cols-3 tablet:w-[calc(1200px-650px)] laptop:w-[calc(1200px-350px)] phone:w-[calc(500px-70px)]  phone:max-tablet:border-hidden">

        @forelse ($products as $product)
            @include('components.product-card', ['product' => $product])
        @empty
            <div class="col-span-full text-center text-gray-500">
                No products found.
            </div>
        @endforelse

        <!-- Pagination Controls -->
    </section>

    <!-- Pagination with Livewire pagination links -->
    <div class="ml-[150px] mt-12">
        {{ $products->links('vendor.livewire.simple-tailwind') }}
    </div>
</section>