<section class="grid tablet:justify-center">
    <header class="flex flex-row justify-between border-b-2 bg-white my-5 mb-10 tablet:mx-[200px] max-w-[1200px] phone:mx-[10px] shadow-sm">
        <a href="/">
            <div class="text-4xl leading-10 text-stone-950">
                <font color="#a28b68">L</font><span class="text-neutral-950">B</span><span class="tetx-stone-950">J</span>
            </div>
        </a>
        <div class="flex flex-row">
            <ul class="flex flex-row gap-8">
                <li class="p-4"><a href="/shop">Shop</a></li>
                <li class="p-4"><a href="/about">About Us</a></li>
            </ul>
            <div class="shrink-0 w-px border bg-neutral-500 h-[22px] my-auto mx-10"></div>
            <div class="flex flex-row p-4 gap-10">
                <button id="open-search-modal" class="cursor-pointer">
                    <img src="/path/to/search-icon.png" alt="Search" class="w-[19px]" />
                </button>
                @livewire('cart')
                <x-user />
            </div>
        </div>
    </header>
</section>

<!-- Modal -->
<div id="search-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50">
    <div class="relative w-full max-w-lg bg-white shadow-2xl p-6">
        <!-- Modal header -->
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <button id="close-search-modal" class="text-gray-400 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal body -->
        <div class="mb-4">
            <input type="text" id="search-input" class="w-full p-3 border-2 border-[#A18A68] rounded-lg" placeholder="Search..." autocomplete="off">
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end">
            <button id="search-button" class="px-6 py-2 bg-[#A18A68] text-white hover:bg-[#d4af37]">Search</button>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    const openModalButton = document.getElementById('open-search-modal');
    const closeModalButton = document.getElementById('close-search-modal');
    const modal = document.getElementById('search-modal');
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        searchInput.focus();
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    searchButton.addEventListener('click', () => {
        const query = searchInput.value.trim();
        if (query) {
            window.location.href = `/shop?search=${encodeURIComponent(query)}`;
        } else {
            alert('Please enter a search term.');
        }
    });
</script>
