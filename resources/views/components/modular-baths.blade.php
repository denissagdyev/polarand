<div class="modular-baths">
    <h2>МОДУЛЬНЫЕ БАНИ</h2>

    <div class="modular-baths__grid">
        @foreach ($products as $product)
            <div class="modular-baths__item">
                <div class="modular-baths__card">
                <h3 class="modular-baths__item-title">{{ strtoupper($product->name) }}</h3>
                    <img src="storage/products/{{ $product->image }}" alt="{{ $product->name }}" class="modular-baths__item-image">
                    <div class="modular-baths__item-info">
                        <p class="modular-baths__item-description">{{ $product->short_description }}</p>
                        <p class="modular-baths__item-price">Цена: {{ number_format($product->price, 0, ',', ' ') }} руб.</p>
                        <a href="#" class="modular-baths__item-button">КУПИТЬ В 1 КЛИК</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="#" class="modular-baths__view-all">
        <span>ПОСМОТРЕТЬ ВСЕ</span>
        <img src="images/str.svg" alt="strBut">
    </a>
</div>