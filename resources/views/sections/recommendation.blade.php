<div class="section" id="recommendation">

    <h2>Recommendation</h2>

    <div class="product-container">

        @foreach ($recommendations as $product)

            <a href="{{ route('products.show', $product->id) }}">

                <div class="product-card">

                    <img src="https://placehold.co/200x120?text=Product" alt="product">

                    <h4>{{ $product->nama_produk }}</h4>

                </div>

            </a>

        @endforeach

    </div>

</div>