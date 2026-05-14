<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <div style="margin-top: 20px; display: flex; gap: 10px;">

        {{-- tombol products --}}
        <a href="{{ route('admin.products.index') }}">
            <button>
                Manage Products
            </button>
        </a>

        {{-- tombol rentals --}}
        <a href="{{ route('admin.rentals.index') }}">
            <button>
                Manage Rentals
            </button>
        </a>

        {{-- tombol logout --}}
        <form action="/logout" method="POST">
            @csrf

            <button type="submit">
                Logout
            </button>
        </form>

    </div>

    <div style="display: flex; gap: 20px; margin-top: 20px;">

        <div style="border: 1px solid black; padding: 20px; width: 200px;">
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>

        <div style="border: 1px solid black; padding: 20px; width: 200px;">
            <h3>Active Rentals</h3>
            <p>{{ $activeRentals }}</p>
        </div>

    </div>

</body>
</html>
