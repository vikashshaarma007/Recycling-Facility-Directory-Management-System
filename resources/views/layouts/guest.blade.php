<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recycling Facility Directory Management System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/style.css') }}">

    <!-- JS -->
    <script src="{{ asset('assets/assets/js/script.js') }}"></script>

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Background -->
    <style>
        .body-class {
            height: 100vh;
            width: 100%;
            background: url("{{ asset('assets/assets/images/hero-bg.jpg') }}") center/cover no-repeat;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased body-class">
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="#" class="logo">
                <img src="{{ asset('assets/assets/images/home.png') }}" alt="logo">
                <h2>RFDMS</h2>
            </a>
            <ul class="links">
                <span class="close-btn material-symbols-rounded">close</span>
                <li><a href="#">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
            <a href="{{ route('login') }}" class="login-btn">
                Login
            </a>
            <a href="{{ route('register') }}" class="login-btn">
                REGISTER
            </a>
        </nav>
    </header>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/" hidden>
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="text-center my-6">
            <h1 class="text-4xl font-extrabold text-white">
                Welcome to the Recycling Facility Directory Management System
            </h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
