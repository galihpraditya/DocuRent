<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Your Cart</h1>

    @if($cart && $cart->cartItems->count() > 0)

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>

        @php
            $total = 0;
        @endphp

        @foreach($cart->cartItems as $item)

        @php
            $subtotal = $item->product->harga_sewa * $item->jumlah;
            $total += $subtotal;
        @endphp

        <tr>
            <td>{{ $item->product->nama_produk }}</td>

            <td>
                Rp {{ number_format($item->product->harga_sewa) }}
            </td>

            <td>
                {{ $item->jumlah }}
            </td>

            <td>
                Rp {{ number_format($subtotal) }}
            </td>

            <td>

                <!-- update quantity -->
                <form action="{{ route('cart-items.update', $item->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <input type="number"
                        name="jumlah"
                        value="{{ $item->jumlah }}"
                        min="1">

                    <button type="submit">
                        Update
                    </button>

                </form>

                <br>

                <!-- remove item -->
                <form action="{{ route('cart-items.destroy', $item->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Remove
                    </button>

                </form>

            </td>
        </tr>

        @endforeach

    </table>

    <h3>
        Total: Rp {{ number_format($total) }}
    </h3>

    <br>

    <!-- checkout -->
    <form action="{{ route('rentals.store') }}" method="POST">

        @csrf

        <button type="submit">
            Checkout Rental
        </button>

    </form>

    @else

    <p>Your cart is empty.</p>

    @endif
</body>
</html>