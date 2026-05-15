<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Payment Status</h1>

    <h3>Booking Code</h3>
    <p>{{ $payment->rental->id }}</p>

    <h3>Total Payment</h3>
    <p>Rp {{ number_format($payment->jumlah_bayar) }}</p>

    <h3>Payment Method</h3>
    <p>{{ $payment->metode_pembayaran }}</p>

    <h3>Payment Status</h3>
    <p>{{ $payment->status_pembayaran }}</p>

    <br>

    @if($payment->bukti_pembayaran)
        <p>Payment proof uploaded successfully.</p>
    @endif
</body>
</html>