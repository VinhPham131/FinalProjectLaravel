document.addEventListener("DOMContentLoaded", () => {
    // Dropdown elements
    const categoryToggle = document.getElementById("categoryToggle");
    const dropdownCategory = document.getElementById("dropdownCategory");
    const sortBy = document.getElementById("sortBy");
    const dropdownSort = document.getElementById("dropdownSort");

    // Toggle Category Dropdown
    categoryToggle.addEventListener("click", (event) => {
        event.stopPropagation(); // Prevent event bubbling to document
        dropdownCategory.classList.toggle("hidden");
        dropdownSort.classList.add("hidden"); // Close Sort dropdown if open
    });

    // Toggle Sort Dropdown
    sortBy.addEventListener("click", (event) => {
        event.stopPropagation(); // Prevent event bubbling to document
        dropdownSort.classList.toggle("hidden");
        dropdownCategory.classList.add("hidden"); // Close Category dropdown if open
    });

    // Prevent closing dropdown when clicking inside dropdownCategory
    dropdownCategory.addEventListener("click", (event) => {
        event.stopPropagation();
    });

    // Prevent closing dropdown when clicking inside dropdownSort
    dropdownSort.addEventListener("click", (event) => {
        event.stopPropagation();
    });

    // Handle click outside to close dropdowns
    document.addEventListener("click", () => {
        dropdownCategory.classList.add("hidden");
        dropdownSort.classList.add("hidden");
    });

    // Track selected categories
    const checkboxes = document.querySelectorAll(".category-checkbox");
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
            const selected = Array.from(checkboxes)
                .filter((cb) => cb.checked)
                .map((cb) => cb.value);

            console.log("Selected Categories:", selected);
        });
    });
});
