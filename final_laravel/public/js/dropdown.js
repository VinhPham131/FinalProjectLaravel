// Desc: Script to toggle the dropdown menu
function toggleDropdownShop() {
    let dropdownShop = document.getElementById('dropdownShop');
    dropdownShop.classList.toggle('hidden');
}
function toggleDropdownSort() {
    let dropdownSort = document.getElementById('dropdownSort');
    dropdownSort.classList.toggle('hidden');
}

document.getElementById('shopBy').addEventListener('click', toggleDropdownShop);
document.getElementById('sortBy').addEventListener('click', toggleDropdownSort);

// Đóng dropdown khi click ra ngoài
document.addEventListener('click', (event) => {
    const shopBy = document.getElementById('shopBy');
    const dropdownShop = document.getElementById('dropdownShop');
    const sortBy = document.getElementById('sortBy');
    const dropdownSort = document.getElementById('dropdownSort');

    if (!shopBy.contains(event.target) && !dropdownShop.contains(event.target)) {
        dropdownShop.classList.add('hidden');
    }

    if (!sortBy.contains(event.target) && !dropdownSort.contains(event.target)) {
        dropdownSort.classList.add('hidden');
    }
});
