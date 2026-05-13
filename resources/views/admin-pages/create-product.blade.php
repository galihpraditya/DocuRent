<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>

    <h1>Tambah Produk</h1>

    <form 
        action="{{ route('admin.products.store') }}" 
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div>
            <label>Nama Produk</label>
            <br>
            <input type="text" name="nama_produk">
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <br>
            <textarea name="deskripsi"></textarea>
        </div>

        <br>

        <div>
            <label>Harga Sewa</label>
            <br>
            <input type="number" name="harga_sewa">
        </div>

        <br>

        <div>
            <label>Stok</label>
            <br>
            <input type="number" name="stok">
        </div>

        <br>

        <div>
            <label>Gambar</label>
            <br>
            <input type="file" name="gambar">
        </div>

        <br>

        <button type="submit">
            Simpan
        </button>
    </form>

</body>
</html>