<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Checkout</h1>

    <h3>Rental Items</h3>

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

    <h3>Rental Date</h3>

    <p>
        {{ $tanggalSewa }}
        →
        {{ $tanggalKembali }}
    </p>

    <h3>Total Price</h3>

    <p>
        Rp {{ number_format($totalHarga) }}
    </p>

    <br>

    <form action="{{ route('rentals.store') }}" method="POST">

        @csrf

        <input type="hidden"
            name="tanggal_sewa"
            value="{{ $tanggalSewa }}">

        <input type="hidden"
            name="tanggal_kembali"
            value="{{ $tanggalKembali }}">

        <label>Payment Method</label>

        <br><br>

        <select name="metode_pembayaran" required>

            <option value="transfer">
                Bank Transfer
            </option>

            <option value="qris">
                QRIS
            </option>

            <option value="ewallet">
                E-Wallet
            </option>

        </select>

        <br><br>

        <button type="submit">
            Pay Now
        </button>

    </form>
</body>
</html>