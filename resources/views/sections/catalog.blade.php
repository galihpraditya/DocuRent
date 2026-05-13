<div class="section" id="catalog">

    <h2>Catalog</h2>

    <div class="product-container">

        @foreach ($catalogs as $product)

            <a href="{{ route('products.show', $product->id) }}">

                <div class="product-card">

                    <img src="https://placehold.co/200x120?text=Product" alt="product">

                    <h4>{{ $product->nama_produk }}</h4>

                </div>

            </a>

        @endforeach

    </div>

</div>