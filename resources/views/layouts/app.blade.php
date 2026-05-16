<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sewa Kamera</title>

    <!-- Memanggil Bootstrap 5 CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    {{-- 
        Menampilkan Navbar. 
        Logika @if ini digunakan agar Navbar TIDAK muncul di halaman Login & Register.
        Karena biasanya halaman login tampil penuh (full screen) tanpa navbar.
        --}}
    @if(!Request::is('login') && !Request::is('register'))
        @include('components.navbar')
    @endif

    {{-- 
      Di sinilah "Keajaiban" Laravel terjadi. 
      Tag @yield('content') akan digantikan oleh isi dari file lain, 
      seperti login.blade.php atau home-page.blade.php yang menggunakan tag @section('content')
    --}}
    <main>
        @yield('content')
    </main>

    <!-- 
      Menampilkan Footer. 
      Sama seperti Navbar, Footer disembunyikan di halaman Login & Register.
    -->
    @if(!Request::is('login') && !Request::is('register'))
        @include('components.footer')
    @endif

    <!-- Memanggil Bootstrap 5 JS Bundle (Sudah termasuk Popper.js untuk dropdown/modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>