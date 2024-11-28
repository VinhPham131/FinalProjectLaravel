document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('default-search');
    const sortSelect = document.getElementById('sort-select'); // Assuming you have a select element for sorting
    const searchResultsContainer = document.querySelector('main .grid');

    let debounceTimeout;

    const fetchFilteredProducts = async (query, sort) => {
        try {
            const response = await fetch(`/shop?search=${encodeURIComponent(query)}&sort=${encodeURIComponent(sort)}`);
            const html = await response.text();

            // Parse the response and replace the product section
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newProducts = doc.querySelector('main .grid');

            if (newProducts) {
                searchResultsContainer.innerHTML = newProducts.innerHTML;
            }
        } catch (error) {
            console.error("Error fetching products:", error);
        }
    };

    const handleSearchAndSort = () => {
        const query = searchInput.value.trim().toLowerCase();
        const sort = sortSelect.value;

        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            fetchFilteredProducts(query, sort);
        }, 300); // Adjust delay as needed
    };

    searchInput.addEventListener('input', handleSearchAndSort);
    sortSelect.addEventListener('change', handleSearchAndSort);
});