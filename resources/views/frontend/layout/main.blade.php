<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $seoTitle ?? ($pageTitle ?? config('app.name')) }}</title>
    <meta name="description" content="{{ $seoDescription ?? ($pageDescription ?? '') }}">
    <link rel="canonical" href="{{ url()->current() }}">
</head>
<body>
    @yield('content')
</body>
</html>

