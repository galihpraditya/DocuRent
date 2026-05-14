<!DOCTYPE html>
<html>
<head>
    <title>Product Detail</title>
</head>
<body>

    <h1>Detail Produk</h1>

    <img 
        src="{{ asset('storage/' . $product->gambar) }}" 
        width="200"
        alt="{{ $product->nama_produk }}"
    >

    <h2>{{ $product->nama_produk }}</h2>

    <p>{{ $product->deskripsi }}</p>

    <p>Harga Sewa: Rp{{ number_format($product->harga_sewa) }}</p>

    <p>Stok: {{ $product->stok }}</p>

    <form action="{{ route('cart-items.store') }}" method="POST">

        @csrf

        <input type="hidden" 
            name="product_id" 
            value="{{ $product->id }}">

        <input type="number" 
            name="jumlah" 
            value="1" 
            min="1">

        <button type="submit">
            Add to Cart
        </button>

    </form>

    <a href="/">
        Kembali
    </a>

</body>
</html>