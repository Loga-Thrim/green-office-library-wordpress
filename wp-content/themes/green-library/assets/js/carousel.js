/**
 * Hero Carousel Script for Green Library Theme
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Support both main carousel and Green Office carousel
        const carousel = document.querySelector('.hero-carousel, .green-office-hero-carousel');
        
        if (!carousel) {
            return; // Exit if no carousel on page
        }

        const slides = carousel.querySelectorAll('.carousel-slide');
        const indicators = carousel.querySelectorAll('.carousel-indicator');
        const prevButton = carousel.querySelector('.carousel-control.prev');
        const nextButton = carousel.querySelector('.carousel-control.next');
        
        let currentSlide = 0;
        let isTransitioning = false;
        let autoplayInterval;
        const autoplayDelay = 6000; // 8 seconds

        // Initialize carousel
        function init() {
            if (slides.length <= 1) {
                // Hide controls if only one slide
                if (prevButton) prevButton.style.display = 'none';
                if (nextButton) nextButton.style.display = 'none';
                if (carousel.querySelector('.carousel-indicators')) {
                    carousel.querySelector('.carousel-indicators').style.display = 'none';
                }
                return;
            }

            // Add event listeners
            if (prevButton) {
                prevButton.addEventListener('click', function() {
                    goToPrevSlide();
                    resetAutoplay();
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function() {
                    goToNextSlide();
                    resetAutoplay();
                });
            }

            // Indicator click events
            indicators.forEach(function(indicator, index) {
                indicator.addEventListener('click', function() {
                    goToSlide(index);
                    resetAutoplay();
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    goToPrevSlide();
                    resetAutoplay();
                } else if (e.key === 'ArrowRight') {
                    goToNextSlide();
                    resetAutoplay();
                }
            });

            // Touch/Swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            carousel.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swiped left - go to next
                        goToNextSlide();
                    } else {
                        // Swiped right - go to prev
                        goToPrevSlide();
                    }
                    resetAutoplay();
                }
            }

            // Pause autoplay on hover
            carousel.addEventListener('mouseenter', function() {
                pauseAutoplay();
            });

            carousel.addEventListener('mouseleave', function() {
                startAutoplay();
            });

            // Start autoplay
            startAutoplay();
        }

        // Go to specific slide
        function goToSlide(index) {
            if (isTransitioning || index === currentSlide) {
                return;
            }

            isTransitioning = true;

            // Remove active class from current slide and indicator
            slides[currentSlide].classList.remove('active');
            if (indicators[currentSlide]) {
                indicators[currentSlide].classList.remove('active');
            }

            // Update current slide
            currentSlide = index;

            // Add active class to new slide and indicator
            slides[currentSlide].classList.add('active');
            if (indicators[currentSlide]) {
                indicators[currentSlide].classList.add('active');
            }

            // Reset transition lock after animation
            setTimeout(function() {
                isTransitioning = false;
            }, 600); // Match CSS transition duration
        }

        // Go to next slide
        function goToNextSlide() {
            const nextIndex = (currentSlide + 1) % slides.length;
            goToSlide(nextIndex);
        }

        // Go to previous slide
        function goToPrevSlide() {
            const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
            goToSlide(prevIndex);
        }

        // Autoplay functions
        function startAutoplay() {
            if (slides.length <= 1) return;
            
            autoplayInterval = setInterval(function() {
                goToNextSlide();
            }, autoplayDelay);
        }

        function pauseAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
            }
        }

        function resetAutoplay() {
            pauseAutoplay();
            startAutoplay();
        }

        // Initialize the carousel
        init();

        // Pause autoplay when page is hidden (tab switched)
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                pauseAutoplay();
            } else {
                startAutoplay();
            }
        });
    });

})();
