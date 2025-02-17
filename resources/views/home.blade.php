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
    </div>
@endsection