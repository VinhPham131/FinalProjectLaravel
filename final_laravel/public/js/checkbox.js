document.addEventListener("DOMContentLoaded", () => {
    const categoryToggle = document.getElementById("categoryToggle");
    const dropdownCategory = document.getElementById("dropdownCategory");

    categoryToggle.addEventListener("click", () => {
        dropdownCategory.classList.toggle("hidden");
    });

    document.addEventListener("click", (event) => {
        if (
            !categoryToggle.contains(event.target) &&
            !dropdownCategory.contains(event.target)
        ) {
            dropdownCategory.classList.add("hidden");
        }
    });

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
