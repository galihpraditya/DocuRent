<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <!-- Tombol Create -->
    <div style="margin-bottom: 20px;">
        <button>Create Product</button>
    </div>

    <!-- List Produk -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}</td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada produk</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
