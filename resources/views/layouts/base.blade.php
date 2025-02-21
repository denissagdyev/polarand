<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/logoHead.png') }}" type="image/x-icon">
    <title>@yield('title', 'Lay')</title> <!-- Заголовок страницы -->

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <!-- Добавь другие необходимые стили здесь (например, для футера, компонентов и т.д.) -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

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
                        <a href="mailto:info@polarandspa.ru" class="header__email"><i class="far fa-envelope"></i>
                            info@polarandspa.ru</a>
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
        <div class="footer__top">
            <div class="footer__logo">
                <img src="images/logofooter.svg" alt="POLARAND">
            </div>
            <div class="footer__social">
            <a class="wh" href="https://api.whatsapp.com/send?phone=79850945520" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a class="tg" href="https://t.me/ndsmaster1" target="_blank">
                    <i class="fab fa-telegram"></i>
                </a>
            </div>
        </div>

        <div class="footer__bottom">
            <div class="footer__column">
                <h4>Купели и бани</h4>
                <ul>
                    <li><a href="#">Купели для бани</a></li>
                    <li><a href="#">Уличные купели</a></li>
                    <li><a href="#">Бочки-купели</a></li>
                    <li><a href="#">Ванны купели</a></li>
                    <li><a href="#">Бассейны купели</a></li>
                    <li><a href="#">Банные чаны купели</a></li>
                    <li><a href="#">Купели для дачи</a></li>
                    <li><a href="#">Недорогие купели</a></li>
                    <li><a href="#">Холодные купели</a></li>
                    <li><a href="#">Большие купели</a></li>
                    <li><a href="#">Купель фурако</a></li>
                    <li><a href="#">Уличные джакузи</a></li>
                    <li><a href="#">Японская офуро</a></li>
                    <li><a href="#">Финские купели</a></li>
                </ul>
            </div>

            <div class="footer__column">
                <h4>Офисы и шоурумы в Москве:</h4>
                <p>ТРЦ "XL Home"</p>
                <p>г. Мытищи, ул. Коммунистическая, 10, корп. 1</p>
                <p>+7 (495) 197-78-00</p>
                <p>+7 991 589 67 02</p>
                <a href="mailto:info@polarspa.ru">info@polarspa.ru</a>

                <h4>ТК «Конструктор»</h4>
                <p>г. Москва, 25-ый км МКАД (внешняя сторона), вл. 1.</p>
                <p>+7 991 589 67 04</p>
                <p>+7 991 636 10 11 (единый номер)</p>
                <p>ПН-ВС 10:00 - 21:00</p>
            </div>

            <div class="footer__column">
                <h4>Производство:</h4>
                <p>ООО «Композит хот спа» УНП (ИНН) 693157383</p>
                <p>222666 Минская обл., г. Столбцы, ул. Моторостроителей, 3д</p>

                <h4>Офис в Минске</h4>
                <p>220125, г. Минск, ул. Гинтовта, 1,</p>
                <p>БЦ А-100, офис 211-213</p>
                <p>+375 29 125 80 80</p>
                <a href="mailto:info@polar-spa.by">info@polar-spa.by</a>
                <p>ПН-ВС 09:00 - 17:00</p>

                <h4>Офис и производство в Турции</h4>
                <p>г. Чанаккале, Isıklar Köyü Testici Kırı,</p>
                <p>Mevkii Can Yolu 23-2 Merkez</p>
                <p>+90 539 644 87 86</p>
                <a href="mailto:eu.polarspa@gmail.com">eu.polarspa@gmail.com</a>
                <p>ПН-ПТ 09:00 - 17:00</p>
            </div>
        </div>
    </div>
</footer>

    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <script src="js/banner.js"></script>
    <script src="js/whatsapp.js"></script>
</body>

</html>