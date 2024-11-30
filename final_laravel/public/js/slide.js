let currentIndex = 0; // Chỉ số slide hiện tại
const imagesContainer = document.getElementById('carousel-images');
const totalSlides = imagesContainer.children.length; // Tổng số ảnh
const visibleSlides = 3; // Số ảnh hiển thị cùng lúc

// Chuyển đến slide chỉ định
function goToSlide(index) {
    if (index >= 0 && index <= totalSlides - visibleSlides) {
        currentIndex = index;
        const offset = -100 / visibleSlides * currentIndex; // Tính khoảng cách theo %
        imagesContainer.style.transform = `translateX(${offset}%)`;
        updateIndicators();
    }
}

// Chuyển đến slide tiếp theo
function nextSlide() {
    if (currentIndex < totalSlides - visibleSlides) {
        goToSlide(currentIndex + 1);
    } else {
        goToSlide(0); // Quay lại slide đầu tiên
    }
}

// Chuyển đến slide trước đó
function prevSlide() {
    if (currentIndex > 0) {
        goToSlide(currentIndex - 1);
    } else {
        goToSlide(totalSlides - visibleSlides); // Quay lại slide cuối cùng
    }
}

// Cập nhật trạng thái của các nút chỉ báo
function updateIndicators() {
    const buttons = document.querySelectorAll('[data-carousel-slide-to]');
    buttons.forEach((button, index) => {
        button.setAttribute('aria-current', index === currentIndex ? 'true' : 'false');
    });
}

// Tự động chuyển slide
setInterval(() => {
    nextSlide();
}, 5000);
