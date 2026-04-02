<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle ?? ($pageTitle ?? config('app.name')) }}</title>
    <meta name="description" content="{{ $seoDescription ?? ($pageDescription ?? '') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="shortcut icon" href="{{ !empty($siteSetting->favicon) ? asset($siteSetting->favicon) : asset('site/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/scss/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/pages.css') }}">
</head>
<body>
    <div id="wrapper">
        @include('frontend.partials.header')
        <main>
            @yield('content')
        </main>
        @include('frontend.partials.footer')
    </div>

    <script src="{{ asset('site/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/swiper.js') }}"></script>
    <script src="{{ asset('site/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/app.js') }}"></script>
    <script src="{{ asset('site/js/pages.js') }}"></script>
</body>
</html>
