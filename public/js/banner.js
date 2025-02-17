document.addEventListener('DOMContentLoaded', function() {
    const bannersWrapper = document.querySelector('.banners-wrapper');
    const bannerItems = document.querySelectorAll('.banner-item');
    const bannersContainer = document.querySelector('.banners-container');
    const bannersDotsContainer = document.querySelector('.banners-dots');
    const slideWidth = bannerItems[0].offsetWidth;
    let currentIndex = 0;
    let intervalId;

    // Создаем точки
    bannerItems.forEach((_, index) => {
        const dot = document.createElement('span');
        dot.classList.add('banners-dot');
        if (index === 0) {
            dot.classList.add('active');
        }
        dot.addEventListener('click', () => {
            goToSlide(index);
            clearInterval(intervalId); // Останавливаем авто-перелистывание
            startAutoSlide(); // Запускаем авто-перелистывание заново
        });
        bannersDotsContainer.appendChild(dot);
    });

    // Функция для перехода к определенному слайду
    function goToSlide(index) {
        currentIndex = index;
        const translateValue = -slideWidth * index;
        bannersWrapper.style.transform = `translateX(${translateValue}px)`;

        // Обновляем активную точку
        const dots = document.querySelectorAll('.banners-dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    // Функция для автоматического перелистывания
    function startAutoSlide() {
        intervalId = setInterval(() => {
            currentIndex = (currentIndex + 1) % bannerItems.length;
            goToSlide(currentIndex);
        }, 30000); // 30 секунд
    }

    startAutoSlide(); // Запускаем автоматическое перелистывание при загрузке страницы

    // Добавляем обработчик события для изменения размера окна
    window.addEventListener('resize', () => {
        // Обновляем ширину слайда при изменении размера окна
        slideWidth = bannerItems[0].offsetWidth;
        goToSlide(currentIndex); // Переходим к текущему слайду
    });
});