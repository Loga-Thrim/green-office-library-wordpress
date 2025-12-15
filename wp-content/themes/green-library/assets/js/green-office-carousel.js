/**
 * Green Office Carousel
 */

let currentSlide = 0;
let autoSlideInterval;

function initGreenOfficeCarousel() {
    const carousel = document.querySelector('.green-office-carousel');
    if (!carousel) return;
    
    const slides = carousel.querySelectorAll('.carousel-slide');
    const dotsContainer = carousel.querySelector('.carousel-dots');
    
    // Create dots
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.className = 'carousel-dot' + (index === 0 ? ' active' : '');
        dot.onclick = () => goToSlide(index, 'green-office');
        dotsContainer.appendChild(dot);
    });
    
    // Start auto-slide
    startAutoSlide('green-office');
}

function moveSlide(direction, type) {
    const carousel = document.querySelector(`.${type}-carousel`);
    if (!carousel) return;
    
    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    
    // Remove active class from current slide
    slides[currentSlide].classList.remove('active');
    dots[currentSlide].classList.remove('active');
    
    // Calculate new slide index
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    
    // Add active class to new slide
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
    
    // Reset auto-slide
    resetAutoSlide(type);
}

function goToSlide(index, type) {
    const carousel = document.querySelector(`.${type}-carousel`);
    if (!carousel) return;
    
    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    
    // Remove active class from current slide
    slides[currentSlide].classList.remove('active');
    dots[currentSlide].classList.remove('active');
    
    // Set new slide
    currentSlide = index;
    
    // Add active class to new slide
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
    
    // Reset auto-slide
    resetAutoSlide(type);
}

function startAutoSlide(type) {
    autoSlideInterval = setInterval(() => {
        moveSlide(1, type);
    }, 5000);
}

function resetAutoSlide(type) {
    clearInterval(autoSlideInterval);
    startAutoSlide(type);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initGreenOfficeCarousel);
