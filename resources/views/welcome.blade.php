<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Recycling Facility Directory Management System</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="{{ asset('assets\assets\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\assets\css\style.css') }}">
    <script src="{{ asset('assets/assets/js/script.js') }}"></script>





</head>

<body class="antialiased bg-gray-100 text-gray-900">
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="#" class="logo">
                <img src="{{ asset('assets\assets\images\home.png') }}" alt="logo">
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
            <div hidden>
                <a href="{{ route('login') }}" class=" login-btn">
                    LOG IN
                </a>
                <a href="{{ route('register') }}" class="login-btn">
                    REGISTER
                </a>
            </div>

            <!-- <button class="login-btn">LOG IN</button> -->
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="min-h-screen flex flex-col justify-center items-center text-center px-6 bg-gray-900">
        <div class="card-footer antialiased bg-gray-100 text-gray-900">
            <h1 class="text-5xl font-extrabold  text-white mb-4">
                Welcome to the Recycling Facility Directory Management System
            </h1>
        </div>

        <div class="card-footer mt-2">
            <p class="text-lg text-white mb-8">
                Manage and explore recycling facilities with ease.
            </p>
            <p class="mb-8 text-white text-lg">
                {{ __('Sign in to access your dashboard or register to get started.') }}
            </p>



            <!-- Buttons -->
            <div>
                <div class="blur-bg-overlay"></div>

                <span class="close-btn material-symbols-rounded">close</span>
                <a href="{{ route('login') }}" class=" btn btn-primary">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary">
                    Register
                </a>
            </div>
        </div>
    </div>



</body>

</html>
