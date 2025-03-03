<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }} | {{ env('APP_NAME') }}</title>

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('theme/dist/css/adminlte.min.css') }}">

    {{-- General Styles --}}
    <link rel="stylesheet" href="{{ asset('theme/dist/css/styles.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="login-body" style="background: #65cea7 url({{url(asset('theme/images/login-bg.jpg'))}}) no-repeat fixed;">
    {{ $slot }}
</body>

</html>