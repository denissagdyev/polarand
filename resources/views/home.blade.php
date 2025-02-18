@extends('layouts.base')

@section('title', 'POLARANDSPA')

@section('content')
    <div class="main-content">
        @if(count($banners) > 0)
            <div class="banners-container">
                <div class="banners-wrapper">
                    @foreach($banners as $banner)
                        <div class="banner-item">
                            <a href="{{ $banner->link }}" target="_blank">
                                <img src="storage/banners/{{ $banner->image }}" alt="{{ $banner->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="banners-dots">
                    <!-- Точки для переключения слайдов будут добавлены позже с помощью JavaScript -->
                </div>
            </div>
        @else
            <p>Баннеры отсутствуют.</p>
        @endif
        <x-whatsapp-form title="Узнайте о наших акциях" buttonText="Подписаться" />
        <x-modular-baths :products="$modularBaths" />
        <x-kupel-elite :products="$kupelElite" />
        <x-kupel-comfort :products="$kupelComfort" />
        <x-kupel-corner :products="$kupelCorner" />
        <x-kupel-standart :products="$kupelStandart" />
        <div class="preim">
            <h2>ПРЕИМУЩЕСТВА <span class="polarand">POLARAND</span></h2>
            <img src="images/preim.svg" alt="preimPhoto">
        </div>
    </div>
@endsection