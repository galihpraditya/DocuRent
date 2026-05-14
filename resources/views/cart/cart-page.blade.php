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

    <form action="{{ route('rentals.calculate') }}" method="POST">

        @csrf

        <label>Rental Start Date</label>
        <input 
            type="date" 
            name="tanggal_mulai"
            value="{{ $tanggalMulai ?? '' }}"
            required
        >

        <br><br>

        <label>Rental End Date</label>
        <input 
            type="date" 
            name="tanggal_selesai"
            value="{{ $tanggalSelesai ?? '' }}"
            required
        >

        <br><br>

        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>Product</th>
                <th>Price / Day</th>
                <th>Quantity</th>
            </tr>

            @foreach($cart->cartItems as $item)

            <tr>
                <td>{{ $item->product->nama_produk }}</td>

                <td>
                    Rp {{ number_format($item->product->harga_sewa) }}
                </td>

                <td>
                    {{ $item->jumlah }}
                </td>
            </tr>

            @endforeach

        </table>

        <br>

        <button type="submit">
            Calculate Total Price
        </button>

    </form>

    @if(isset($totalHarga))

        <h3>Total Price: Rp {{ number_format($totalHarga) }}</h3>

        <form action="{{ route('rentals.store') }}" method="POST">

            @csrf

            <input type="hidden" 
                name="tanggal_mulai" 
                value="{{ $tanggalMulai }}">

            <input type="hidden" 
                name="tanggal_selesai" 
                value="{{ $tanggalSelesai }}">

            <button type="submit">
                Checkout Rental
            </button>

        </form>

    @endif

    @else

    <p>Your cart is empty.</p>

    @endif
</body>
</html>