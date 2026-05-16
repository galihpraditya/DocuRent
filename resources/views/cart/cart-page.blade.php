<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart Page</title>
</head>
<body>

    <h1>Your Cart</h1>

    @if($cart && $cart->cartItems->count() > 0)

        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>Product</th>
                <th>Price / Day</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

            @foreach($cart->cartItems as $item)

                @php
                    $subtotal =
                        $item->product->harga_sewa *
                        $item->jumlah *
                        ($hari ?? 1);
                @endphp

                <tr>

                    <td>
                        {{ $item->product->nama_produk }}
                    </td>

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

                        {{-- Update quantity --}}
                        <form 
                            action="{{ route('cart-items.update', $item->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PUT')

                            <input 
                                type="number"
                                name="jumlah"
                                value="{{ $item->jumlah }}"
                                min="1"
                            >

                            <button type="submit">
                                Update
                            </button>

                        </form>

                        <br>

                        {{-- Remove item --}}
                        <form 
                            action="{{ route('cart-items.destroy', $item->id) }}"
                            method="POST"
                        >

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

        <br>

        {{-- Form calculate total price --}}
        <form action="{{ route('cart.calculate') }}" method="POST">

            @csrf

            <label>Rental Start Date</label>
            <input 
                type="date" 
                name="tanggal_sewa"
                value="{{ $tanggalMulai ?? '' }}"
                required
            >

            <br><br>

            <label>Rental End Date</label>
            <input 
                type="date" 
                name="tanggal_kembali"
                value="{{ $tanggalSelesai ?? '' }}"
                required
            >

            <br><br>

            <button type="submit">
                Calculate Total Price
            </button>

        </form>

        @if(isset($totalHarga))

            <h3>
                Total Price: Rp {{ number_format($totalHarga) }}
            </h3>

            <form action="{{ route('rentals.checkout-page') }}" method="POST">

                @csrf

                <input 
                    type="hidden" 
                    name="tanggal_sewa"
                    value="{{ $tanggalMulai }}"
                >

                <input 
                    type="hidden" 
                    name="tanggal_kembali"
                    value="{{ $tanggalSelesai }}"
                >

                <button type="submit">
                    Checkout
                </button>

            </form>

        @endif

    @else

        <p>Your cart is empty.</p>

    @endif

</body>
</html>