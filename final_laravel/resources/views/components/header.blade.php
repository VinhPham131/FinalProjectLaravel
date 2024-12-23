<header
        class="flex flex-row justify-between border-b-2 bg-white my-5 mb-10 phone:max-tablet:mb-10 phone:max-tablet:border-b-0 tablet:mx-[200px] tablet:max-w-[1200px] phone:mx-[10px] tablet:w-[calc(1200px-350px)] laptop:w-[calc(1200px-100px)] shadow-sm">
        <div class="flex flex-row mt-1 ml-2 tablet:hidden">
            <a href="#">
                <img loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                    alt="Image description" class="size-7" />
            </a>
        </div>
        <a href="/">
            <div class="text-4xl leading-10 text-stone-950 phone:max-tablet:ml-0 phone:max-tablet:mb-5">
                <font color="#a28b68">L</font><span class="text-neutral-950">B</span><span class="tetx-stone-950">J</span>
            </div>
        </a>
        <div class="flex flex-row phone:max-tablet:hidden">
            <ul class="flex flex-row gap-8">
                <li class="p-4"><a href="/shop">Shop</a></li>
                <li class="p-4"><a href="/about">About Us</a></li>
            </ul>
            <div
                class="shrink-0 w-px border border-solid bg-neutral-500 border-neutral-500 h-[22px] my-auto mx-10"></div>
            <div class="flex flex-row p-4 gap-10">
                <!-- Search Icon -->
                <button id="open-search-modal" class="cursor-pointer">
                    <img loading="lazy"
                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/b53ad79a5e4ea34706fc375724ee506199b29340c27f09c40ae777a95cc73c28?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                        alt="Search Icon"
                        class="shrink-0 self-start border border-white border-solid aspect-square fill-black stroke-[0.75px] stroke-white w-[19px]" />
                </button>

                <!-- Cart -->
                @livewire('cart')

                <!-- User -->
                <x-user />
            </div>
        </div>
    </header>
</section>


<!-- Modal for Search -->
<div id="search-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50">
    <div class="relative w-full max-w-lg bg-white rounded-xl shadow-2xl p-6">
        <!-- Modal header -->
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h3 class="text-xl font-semibold text-[#A18A68]">Search</h3>
            <button id="close-search-modal" class="text-gray-400 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="mb-4">
            <input type="text" id="search-input" class="w-full p-3 border-2 border-[#A18A68] rounded-lg focus:ring-2 focus:ring-[#A18A68] transition" placeholder="Search..." autocomplete="off">
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end">
            <button id="search-button" class="px-6 py-2 bg-[#A18A68] text-white rounded-lg hover:bg-[#d4af37] transition-all">Search</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalButton = document.getElementById('open-search-modal');
        const closeModalButton = document.getElementById('close-search-modal');
        const modal = document.getElementById('search-modal');
        const searchButton = document.getElementById('search-button');
        const searchInput = document.getElementById('search-input');

        // Open modal
        openModalButton?.addEventListener('click', () => {
            modal.classList.remove('hidden');
            searchInput.focus();
        });

        // Close modal
        closeModalButton?.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Handle search button click
        searchButton?.addEventListener('click', () => {
            performSearch();
        });

        // Handle Enter key for search
        searchInput?.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                performSearch();
            }
        });

        // Perform search
        const performSearch = () => {
            const query = searchInput.value.trim();
            if (query) {
                searchButton.innerHTML = 'Searching...'; // Show loading text
                searchButton.disabled = true;

                // Redirect to search results page
                setTimeout(() => {
                    window.location.href = `/shop?search=${encodeURIComponent(query)}`;
                    searchButton.innerHTML = 'Search';
                    searchButton.disabled = false;
                }, 500);
            } else {
                alert('Please enter a search term.');
            }
        };
    });
</script>