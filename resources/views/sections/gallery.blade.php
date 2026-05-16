<div>
    <h3 class="fw-bold mb-4 border-bottom border-dark pb-2">Galeri & Testimoni</h3>
    
    <h5 class="fw-bold mt-4 mb-3">Dokumentasi Alat & Event</h5>
    <div class="product-container">
        @for ($i = 0; $i < 4; $i++)
        <!-- Lebar kartu dimodifikasi menjadi 250px khusus galeri -->
        <div class="product-card" style="width: 250px;">
            <img src="{{ asset('images/gallery.jpg') }}" alt="Galeri" class="img-fluid">
        </div>
        @endfor
    </div>

    <h5 class="fw-bold mt-5 mb-3">Apa Kata Mereka?</h5>
    <div class="product-container">
        @for ($i = 0; $i < 3; $i++)
        <!-- Kartu testimoni dirancang lebih lebar (300px) untuk memuat teks -->
        <div class="product-card" style="width: 300px; padding: 20px;">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-person-circle fs-3 me-2 text-muted"></i>
                <div>
                    <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">Budiono Siregar</h6>
                    <small class="text-muted" style="font-size: 0.75rem;">Mahasiswa</small>
                </div>
            </div>
            <p class="small text-dark mb-0 fst-italic">"Harga sewa di sini sangat terjangkau, alatnya dirawat dengan baik. Pokoknya recomended banget buat nugas kampus!"</p>
        </div>
        @endfor
    </div>
</div>