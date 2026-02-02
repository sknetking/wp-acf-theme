/**
 * Client Logos Slider
 * Handles the sliding functionality for client logos
 */

document.addEventListener('DOMContentLoaded', function () {
    const clientLogosSliders = document.querySelectorAll('.client-logos-slider');

    clientLogosSliders.forEach(function (slider) {
        const wrapper = slider.querySelector('.client-logos-wrapper');
        const prevBtn = slider.querySelector('.slider-prev');
        const nextBtn = slider.querySelector('.slider-next');
        const slides = slider.querySelectorAll('.client-logo-slide');

        if (!wrapper || !prevBtn || !nextBtn || slides.length === 0) {
            return;
        }

        let currentIndex = 0;
        let slidesPerView = getSlidesPerView();
        let maxIndex = Math.max(0, slides.length - slidesPerView);

        // Initialize
        updateSlider();

        // Handle window resize
        window.addEventListener('resize', function () {
            slidesPerView = getSlidesPerView();
            maxIndex = Math.max(0, slides.length - slidesPerView);
            currentIndex = Math.min(currentIndex, maxIndex);
            updateSlider();
        });

        // Previous button click
        prevBtn.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        // Next button click
        nextBtn.addEventListener('click', function () {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });

        // Touch/swipe support for mobile
        let startX = 0;
        let currentX = 0;
        let isDragging = false;

        wrapper.addEventListener('touchstart', function (e) {
            startX = e.touches[0].clientX;
            isDragging = true;
            wrapper.style.transition = 'none';
        });

        wrapper.addEventListener('touchmove', function (e) {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
            const diff = currentX - startX;
            const translateX = -(currentIndex * (100 / slidesPerView)) + (diff / slider.offsetWidth * 100);
            wrapper.style.transform = `translateX(${translateX}%)`;
        });

        wrapper.addEventListener('touchend', function (e) {
            if (!isDragging) return;
            isDragging = false;
            wrapper.style.transition = 'transform 0.5s ease-in-out';

            const diff = currentX - startX;
            const threshold = slider.offsetWidth / 4; // 25% of slider width

            if (diff > threshold && currentIndex > 0) {
                currentIndex--;
            } else if (diff < -threshold && currentIndex < maxIndex) {
                currentIndex++;
            }

            updateSlider();
        });

        // Mouse drag support for desktop
        wrapper.addEventListener('mousedown', function (e) {
            startX = e.clientX;
            isDragging = true;
            wrapper.style.transition = 'none';
            wrapper.style.cursor = 'grabbing';
            e.preventDefault();
        });

        document.addEventListener('mousemove', function (e) {
            if (!isDragging) return;
            currentX = e.clientX;
            const diff = currentX - startX;
            const translateX = -(currentIndex * (100 / slidesPerView)) + (diff / slider.offsetWidth * 100);
            wrapper.style.transform = `translateX(${translateX}%)`;
        });

        document.addEventListener('mouseup', function (e) {
            if (!isDragging) return;
            isDragging = false;
            wrapper.style.transition = 'transform 0.5s ease-in-out';
            wrapper.style.cursor = 'grab';

            const diff = currentX - startX;
            const threshold = slider.offsetWidth / 4; // 25% of slider width

            if (diff > threshold && currentIndex > 0) {
                currentIndex--;
            } else if (diff < -threshold && currentIndex < maxIndex) {
                currentIndex++;
            }

            updateSlider();
        });

        function getSlidesPerView() {
            const width = window.innerWidth;
            if (width <= 480) return 1;      // Mobile: 1 logo
            if (width <= 768) return 2;      // Tablet: 2 logos
            if (width <= 1024) return 3;     // Small desktop: 3 logos
            return 4;                        // Desktop: 4 logos
        }

        function updateSlider() {
            const translateX = -(currentIndex * (100 / slidesPerView));
            wrapper.style.transform = `translateX(${translateX}%)`;

            // Update button states
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;

            // Add ARIA attributes for accessibility
            prevBtn.setAttribute('aria-label', `Previous logos (${currentIndex + 1} of ${maxIndex + 1})`);
            nextBtn.setAttribute('aria-label', `Next logos (${currentIndex + 1} of ${maxIndex + 1})`);
        }

        // Auto-play functionality (optional)
        let autoplayInterval;

        function startAutoplay() {
            autoplayInterval = setInterval(function () {
                if (currentIndex >= maxIndex) {
                    currentIndex = 0;
                } else {
                    currentIndex++;
                }
                updateSlider();
            }, 5000); // Change every 5 seconds
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        // Pause autoplay on hover
        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', function () {
            if (slider.dataset.autoplay === 'true') {
                startAutoplay();
            }
        });

        // Start autoplay if enabled
        if (slider.dataset.autoplay === 'true') {
            startAutoplay();
        }
    });
});
