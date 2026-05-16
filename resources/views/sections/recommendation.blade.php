<div>
    <h3 class="fw-bold mb-4 border-bottom border-dark pb-2">Rekomendasi</h3>
    <p class="text-muted small mb-4">Dapatkan harga terbaik untuk paket penyewaan tertentu bulan ini.</p>
    
    <div class="product-container">
        @foreach ($recommendations as $product)

        <div class="product-card">

            <a href="{{ route('products.show', $product->id) }}">

                <img 
                    src="{{ asset('storage/' . $product->gambar) }}"
                    alt="{{ $product->nama_produk }}"
                    class="img-fluid"
                >

                <h6 class="fw-bold small mb-1">
                    {{ $product->nama_produk }}
                </h6>

                <p class="small text-danger fw-bold mb-0">
                    Rp. {{ number_format($product->harga_sewa, 0, ',', '.') }} / hari
                </p>

            </a>

        </div>

        @endforeach
    </div>
</div>