<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

    <h1>Edit Produk</h1>

    <form 
        action="{{ route('admin.products.update', $product->id) }}" 
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <img 
            src="{{ asset('storage/' . $product->gambar) }}" 
            width="120"
        >

        <br><br>
        
        <div>
            <label>Nama Produk</label>
            <br>
            <input 
                type="text" 
                name="nama_produk"
                value="{{ $product->nama_produk }}"
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <br>
            <textarea name="deskripsi">{{ $product->deskripsi }}</textarea>
        </div>

        <br>

        <div>
            <label>Harga Sewa</label>
            <br>
            <input 
                type="number" 
                name="harga_sewa"
                value="{{ $product->harga_sewa }}"
            >
        </div>

        <br>

        <div>
            <label>Stok</label>
            <br>
            <input 
                type="number" 
                name="stok"
                value="{{ $product->stok }}"
            >
        </div>

        <br>

        <div>
            <label>Gambar Baru</label>
            <br>
            <input type="file" name="gambar">
        </div>

        <br>

        <button type="submit">
            Update
        </button>
    </form>

</body>
</html>