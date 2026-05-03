<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

    <h1>Halaman Home</h1>

    <!-- Nama User dari Session -->
    @if(Auth::check())
        <p>
            Selamat datang, 
            <strong>{{ Auth::user()->username }}</strong>
        </p>
    @else
        <p>Anda belum login</p>
    @endif

    <hr>

    <!-- List Products -->
    <h2>Daftar Produk</h2>

    @if($products->isEmpty())
        <p>Tidak ada produk.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li>
                    {{ $product->nama_produk }}<br>
                    Harga: Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}
                </li>
                <br>
            @endforeach
        </ul>
    @endif

</body>
</html>
