<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Manage Rentals</h1>

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($rentals as $rental)
        <tr>
            <td>{{ $rental->id }}</td>
            <td>{{ $rental->user->nama }}</td>
            <td>{{ $rental->total_harga }}</td>
            <td>{{ $rental->status }}</td>
            <td>
                <a href="{{ route('admin.rentals.show', $rental->id) }}">
                    Detail
                </a>
            </td>
        </tr>
        @endforeach

    </table>
</body>
</html>