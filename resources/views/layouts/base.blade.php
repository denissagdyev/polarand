<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Lay')</title>  <!-- Заголовок страницы -->

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- Добавь другие необходимые стили здесь (например, для футера, компонентов и т.д.) -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="antialiased">
<header class="header">
    <div class="container">
        <div class="header__inner">
            <a href="/" class="header__logo">
                <img src="images/logo.png" alt="POLARAND" width="150">
            </a>

            <div class="header__center">
                <nav class="header__nav">
                    <a href="#" class="header__nav-link"><i class="fas fa-bars"></i> КАТАЛОГ</a>
                    <a href="#" class="header__nav-link">ПОРТФОЛИО</a>
                    <a href="#" class="header__nav-link">О КОМПАНИИ</a>
                    <a href="#" class="header__nav-link">КОНТАКТЫ</a>
                    <a href="#" class="header__nav-link">ГАЛЕРЕЯ</a>
                </nav>

                <div class="header__search">
                    <input type="text" class="header__search-input" placeholder="Поиск">
                    <button class="header__search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="header__contacts">
                <div class="header__contacts-info">
                    <span class="header__worktime"><i class="far fa-clock"></i> ПН-ВС 09:00-21:00</span>
                    <a href="mailto:info@polarandspa.ru" class="header__email"><i class="far fa-envelope"></i> info@polarandspa.ru</a>
                    <a href="tel:88001012623" class="header__phone"><i class="fas fa-phone"></i> 8 800 101-26-23</a>
                </div>
                <button class="header__callback">
                    <img class="phone" src="images/phoneWhite.png" alt="phoneWhite"> ЗАКАЗАТЬ ЗВОНОК
                </button>
            </div>
        </div>
    </div>
</header>

    <main class="main">
        <div class="container">
            @yield('content')  <!-- Здесь будет содержимое страницы -->
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <!-- Содержимое футера -->
            <p>&copy; 2024 Polarand. Все права защищены.</p>  <!-- Пример -->
        </div>
    </footer>

    @vite('resources/js/app.js')
    <script src="js/banner.js"></script>
    <script src="js/whatsapp.js"></script>
</body>
</html>