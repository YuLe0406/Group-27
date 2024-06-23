let currentSlide = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('.slide');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }
    const offset = -currentSlide * 100;
    document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
    updatePagination();
}

function moveSlide(step) {
    showSlide(currentSlide + step);
}

function currentSlideIndex(index) {
    showSlide(index);
}

function updatePagination() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);
    setInterval(() => moveSlide(1), 6000); // Automatically move to the next slide every 6 seconds
});
