<div>
    <h3 class="fw-bold mb-4 border-bottom border-dark pb-2">Rekomendasi</h3>
    <p class="text-muted small mb-4">Dapatkan harga terbaik untuk paket penyewaan tertentu bulan ini.</p>
    
    <div class="product-container">
        @for ($i = 0; $i < 4; $i++)
        <div class="product-card">
            <!-- Kotak Placeholder Gambar Promo -->
            <img src="{{ asset('images/recommendation.jpg') }}" alt="Rekomendasi" class="img-fluid">
            
            <h6 class="fw-bold small mb-1">Paket Wedding Basic</h6>
            <p class="small text-decoration-line-through text-muted mb-0">Rp. 800.000</p>
            <p class="small text-danger fw-bold mb-0">Rp. 650.000 / hari</p>
        </div>
        @endfor
    </div>
</div>