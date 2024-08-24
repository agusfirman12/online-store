<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- swiper js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        /* Tambahkan transisi untuk efek yang lebih halus */
        .transition-blur {
            transition: backdrop-filter 0.3s ease;
        }
    </style>
</head>

<body class="font-sans antialiased">
    @include('home.layouts.nav')

    @yield('content')

    {{-- flowbite js --}}
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');

            if (window.scrollY > 100) {
                navbar.classList.add('backdrop-blur-sm', 'bg-white/30');
            } else {
                navbar.classList.remove('backdrop-blur-sm', 'bg-white/30');
            }
        });
    </script>
</body>

</html>
