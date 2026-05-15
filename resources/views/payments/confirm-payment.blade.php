<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Confirm Payment</h1>

    <h3>Total Payment</h3>
    <p>Rp {{ number_format($payment->jumlah_bayar) }}</p>

    <h3>Payment Destination</h3>

    <p>BCA : 123456789</p>
    <p>OVO : 08123456789</p>

    <br>

    <form action="{{ route('payments.upload-proof', $payment->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <label>Upload Payment Proof</label>
        <br><br>

        <input type="file"
            name="bukti_pembayaran"
            required>

        <br><br>

        <button type="submit">
            Submit Payment Proof
        </button>

    </form>
</body>
</html>