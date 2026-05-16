<div>
    <h3 class="fw-bold mb-4 border-bottom border-dark pb-2">Katalog Produk</h3>
    
    <div class="row mt-4">
        <!-- Sidebar Filter (Kiri) -->
        <div class="col-md-3 mb-4">
            <div class="bg-dark text-white p-4 rounded-3" style="top: 100px;">
                <h6 class="fw-bold border-bottom border-secondary pb-2 text-center">Filter</h6>
                
                <div class="mt-3">
                    <a href="#" class="text-white text-decoration-none fw-semibold"><i class="bi bi-grid-fill me-2"></i> Semua Produk</a>
                </div>

                <div class="mt-4">
                    <p class="fw-semibold mb-2"><i class="bi bi-tags-fill me-2"></i> Kategori</p>
                    <div class="ps-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="cat1"><label class="form-check-label small" for="cat1">Kamera</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="cat2"><label class="form-check-label small" for="cat2">Lensa</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="cat3"><label class="form-check-label small" for="cat3">Lighting</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="cat4"><label class="form-check-label small" for="cat4">Audio</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="cat5"><label class="form-check-label small" for="cat5">Drone</label></div>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="fw-semibold mb-2"><i class="bi bi-sort-down me-2"></i> Urutkan</p>
                    <div class="ps-4">
                        <select class="form-select form-select-sm bg-dark text-white border-secondary mb-2">
                            <option>Termurah</option>
                            <option>Termahal</option>
                            <option>Terbaru</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Produk (Kanan) -->
        <div class="col-md-9">
            <!-- Menggunakan flex-start agar produk berjejer rapi ke kiri saat digabungkan dengan sidebar -->
            <div class="product-container" style="justify-content: flex-start;">

                @foreach ($catalogs as $product)

                <div class="product-card">

                    <img 
                        src="{{ asset('storage/' . $product->gambar) }}"
                        alt="{{ $product->nama_produk }}"
                        class="img-fluid"
                    >

                    <h6 class="fw-bold small mb-1">
                        {{ $product->nama_produk }}
                    </h6>

                    <p class="small text-muted mb-0">
                        Rp. {{ number_format($product->harga_sewa, 0, ',', '.') }} / hari
                    </p>

                    <a 
                        href="{{ route('products.show', $product->id) }}"
                        class="btn btn-sm btn-outline-dark w-100 mt-2 fw-semibold"
                        style="font-size: 0.8rem;"
                    >
                        <i class="bi bi-cart-plus"></i> Sewa
                    </a>

                </div>

                @endforeach

            </div>
        </div>
    </div>
</div>