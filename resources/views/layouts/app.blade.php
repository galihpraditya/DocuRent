<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Docurent - Sewa Kamera & Alat Dokumentasi</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- HTMX for Instant Navigation -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body hx-boost="true" class="bg-zinc-50 text-zinc-900 antialiased selection:bg-rose-500 selection:text-white flex flex-col min-h-screen">
    
    @if(!Request::is('login') && !Request::is('register'))
        @include('components.navbar')
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    @if(Request::is('/'))
        @include('components.footer')
    @endif

</body>
</html>