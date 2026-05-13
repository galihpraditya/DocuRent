<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>

    <h1>Daftar Produk</h1>

    <a href="{{ route('admin.products.create') }}">Tambah Produk</a>

    <hr>

    @foreach ($products as $product)
        <div style="margin-bottom: 10px;">
            <img 
                src="{{ asset('storage/' . $product->gambar) }}" 
                width="120"
                alt="Image of {{ $product->nama_produk }}"
            >

            <h3>{{ $product->nama_produk }}</h3>

            <p>
                Harga Sewa: Rp{{ number_format($product->harga_sewa) }}<br>
                Stok: {{ $product->stok }}
            </p>

            <a href="{{ route('products.show', $product->id) }}">
                Detail
            </a>
            <br>
            <a href="{{ route('admin.products.edit', $product->id) }}">
                Edit
            </a>

            <form 
                action="{{ route('admin.products.destroy', $product->id) }}" 
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>
        </div>

        <hr>
    @endforeach

</body>
</html>