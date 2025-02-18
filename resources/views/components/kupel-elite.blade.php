<div class="modular-baths">
    <h2>КУПЕЛИ ЛИНЕЙКИ <span class="kupelTitle">ELITE</span></h2>

    <div class="modular-baths__grid">
        @foreach ($products as $product)
            <div class="modular-baths__item">
                <div class="modular-baths__card">
                    <div class="modular-baths__item-front">
                        <h3 class="modular-baths__item-title">{{ strtoupper($product->name) }}</h3>
                        <img src="storage/products/{{ $product->image }}" alt="{{ $product->name }}">
                        <p class="modular-baths__item-description">{{ $product->short_description }}</p>
                    </div>
                    <div class="modular-baths__item-back">
                        <div class="modular-baths__item-back-content">
                            <h3 class="modular-baths__item-title">{{ strtoupper($product->name) }}</h3>
                            <p class="modular-baths__item-description">{{ $product->short_description }}</p>
                            <p class="modular-baths__item-size">Размер: {{ $product->size }}</p>
                            <p class="modular-baths__item-price">Цена: {{ $product->price }}</p>
                        </div>
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