<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<h1>Rental Detail</h1>

<br>

<h3>Booking Code</h3>
<p>{{ $rental->id }}</p>

<h3>Rental Status</h3>
<p>{{ $rental->status }}</p>

<h3>Payment Status</h3>
<p>{{ $rental->payment->status_pembayaran }}</p>

<br>

<h3>Important Dates</h3>

<ul>

    <li>
        Rental Date :
        {{ $rental->tanggal_sewa }}
    </li>

    <li>
        Return Date :
        {{ $rental->tanggal_kembali }}
    </li>

</ul>

<br>

<h3>Rental Items</h3>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>Product</th>
        <th>Price / Day</th>
        <th>Quantity</th>
    </tr>

    @foreach($rental->rentalItems as $item)

    <tr>

        <td>
            {{ $item->product->nama_produk }}
        </td>

        <td>
            Rp {{ number_format($item->harga_saat_sewa) }}
        </td>

        <td>
            {{ $item->jumlah }}
        </td>

    </tr>

    @endforeach

</table>

<br>

<h3>Total Price</h3>

<p>
    Rp {{ number_format($rental->total_harga) }}
</p>

</body>
</html>