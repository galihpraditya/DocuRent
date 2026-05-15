<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .section{
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .product-container{
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product-card{
            width: 180px;
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        .product-card img{
            width: 100%;
            height: 120px;
            object-fit: cover;
            background: #ddd;
        }

        .nav-button{
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <h1>Home Page</h1>

    {{-- tombol pindah section --}}
    <a href="#recommendation">
        <button class="nav-button">Recommendation</button>
    </a>

    <a href="#catalog">
        <button class="nav-button">Catalog</button>
    </a>

    <a href="#gallery">
        <button class="nav-button">Gallery</button>
    </a>

    <a href="{{ route('cart.index') }}">
        <button>
            View Cart
        </button>
    </a>

    <form action="/logout" method="POST">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>

    {{-- include sections --}}
    @include('sections.recommendation')

    @include('sections.catalog')

    @include('sections.gallery')

</body>
</html>