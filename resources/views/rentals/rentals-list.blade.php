<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>My Rentals</h1>

<br>

<!-- filter buttons -->
<a href="{{ route('rentals.list') }}">
    All
</a>

|

<a href="{{ route('rentals.filter', 'pending') }}">
    Pending
</a>

|

<a href="{{ route('rentals.filter', 'ongoing') }}">
    Ongoing
</a>

|

<a href="{{ route('rentals.filter', 'completed') }}">
    Completed
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>Booking Code</th>
        <th>Rental Date</th>
        <th>Return Date</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @forelse($rentals as $rental)

    <tr>

        <td>
            {{ $rental->id }}
        </td>

        <td>
            {{ $rental->tanggal_sewa }}
        </td>

        <td>
            {{ $rental->tanggal_kembali }}
        </td>

        <td>
            Rp {{ number_format($rental->total_harga) }}
        </td>

        <td>
            {{ $rental->status }}
        </td>

        <td>
            <a href="{{ route('rentals.show', $rental->id) }}">
                Detail
            </a>
        </td>

    </tr>

    @empty

    <tr>
        <td colspan="6">
            No rentals found
        </td>
    </tr>

    @endforelse

</table>
</body>
</html>