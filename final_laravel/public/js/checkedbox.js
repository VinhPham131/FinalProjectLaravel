document.addEventListener('DOMContentLoaded', function () {
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const searchForm = document.getElementById('search-form');

    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateProductList();
        });
    });

    function updateProductList() {
        const selectedCategories = Array.from(categoryCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        const searchParams = new URLSearchParams(new FormData(searchForm));
        searchParams.set('categories', selectedCategories.join(','));

        fetch(`/shop?${searchParams.toString()}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('searchResults').innerHTML = html;
            });
    }
});
