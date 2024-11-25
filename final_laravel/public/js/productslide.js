let slideIndex = 1;
showSlides(slideIndex);

// Điều hướng slide trước/sau
function plusSlides(n) {
    showSlides((slideIndex += n));
}

// Hiển thị slide theo index
function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName('mySlides');
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none'; // Ẩn tất cả các slide
    }
    slides[slideIndex - 1].style.display = 'block'; // Hiển thị slide được chọn
}

// Chuyển slide khi click vào ảnh nhỏ
function showSlide(n) {
    slideIndex = n + 1; // Cập nhật slideIndex
    showSlides(slideIndex); // Gọi hàm hiển thị
}

// Xử lý sự kiện cho nút điều hướng
document.querySelector('.prev').addEventListener('click', () => plusSlides(-1));
document.querySelector('.next').addEventListener('click', () => plusSlides(1));
