document.addEventListener('DOMContentLoaded', function () {
    const bannersContainer = document.querySelector('.banners-container');
    const bannersWrapper = document.querySelector('.banners-wrapper');
    const bannerItems = document.querySelectorAll('.banner-item');
    const bannersDots = document.querySelector('.banners-dots');
    let currentIndex = 0;
    let translateX = 0;
    let startX = 0;
    let isDragging = false;
    let animationID = null;
    let intervalId;

    // Создание точек навигации
    bannerItems.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('banners-dot');
        dot.addEventListener('click', () => goToSlide(index));
        bannersDots.appendChild(dot);
    });

    const dots = document.querySelectorAll('.banners-dot');

    function updateDots() {
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    }

    function goToSlide(index) {
        currentIndex = index;
        translateX = -currentIndex * 100;
        bannersWrapper.style.transform = `translateX(${translateX}%)`;
        updateDots();
        resetInterval();
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % bannerItems.length;
        goToSlide(currentIndex);
    }

    function resetInterval() {
        clearInterval(intervalId);
        intervalId = setInterval(nextSlide, 5000);
    }

    // Hammer instance для drag gesture
    const hammer = new Hammer(bannersContainer);

    hammer.on('panstart', function (ev) {
        // Prevent default browser behavior during drag
        ev.preventDefault();
    });

    hammer.on('panleft panright', function (ev) {
        // Prevent default browser behavior during drag
        ev.preventDefault();
        if (ev.type == "panleft") {
            nextSlide();
        } else if (ev.type == "panright") {
            prevSlide();
        }
    });

    function prevSlide() {
        currentIndex = (currentIndex - 1 + bannerItems.length) % bannerItems.length;
        goToSlide(currentIndex);
    }

    resetInterval();
    updateDots();
});