<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DocuRent — Sewa Kamera & Alat Dokumentasi</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- HTMX for Instant Navigation -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    
    <!-- NProgress for Loading Indicator -->
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
        }
        /* Minimalist Sleek NProgress Colors */
        #nprogress .bar {
            background: #18181b !important;
            height: 3px !important;
        }
        #nprogress .peg {
            box-shadow: 0 0 8px #18181b, 0 0 4px #18181b !important;
        }
        #nprogress .spinner-icon {
            border-top-color: #18181b !important;
            border-left-color: #18181b !important;
        }
    </style>
    
    <script>
        // HTMX NProgress Integration
        document.addEventListener('htmx:beforeRequest', function() {
            NProgress.start();
        });
        document.addEventListener('htmx:afterRequest', function() {
            NProgress.done();
        });
        document.addEventListener('htmx:beforeHistorySave', function() {
            const np = document.getElementById('nprogress');
            if (np) np.remove();
        });
    </script>
</head>
<body hx-boost="true" class="bg-[#FCFCFC] text-zinc-900 antialiased selection:bg-zinc-900 selection:text-white flex flex-col min-h-screen">
    
    @if(!Request::is('login') && !Request::is('register'))
        @include('components.navbar')
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    @if(!Request::is('login') && !Request::is('register'))
        @include('components.footer')
    @endif

    @include('components.portfolio-modal')

</body>
</html>