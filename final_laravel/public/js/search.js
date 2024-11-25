document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('default-search');
    const searchResultsContainer = document.querySelector('main .grid');

    const fetchFilteredProducts = async (query) => {
        try {
            const response = await fetch(`/shop?search=${encodeURIComponent(query)}`);
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

    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.trim().toLowerCase();
        fetchFilteredProducts(query);
    });
});
