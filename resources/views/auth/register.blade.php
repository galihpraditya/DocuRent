<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h2>Register</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <div>
            <label>Nama</label><br>
            <input type="text" name="nama" required>
        </div>

        <br>

        <div>
            <label>Username</label><br>
            <input type="text" name="username" required>
        </div>

        <br>

        <div>
            <label>Email</label><br>
            <input type="email" name="email" required>
        </div>

        <br>

        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>

        <br>

        <div>
            <label>Konfirmasi Password</label><br>
            <input type="password" name="password_confirmation" required>
        </div>

        <br>

        <div>
            <label>No HP</label><br>
            <input type="text" name="no_hp" required>
        </div>

        <br>

        <div>
            <label>Alamat</label><br>
            <textarea name="alamat" required></textarea>
        </div>

        <br>

        <button type="submit">Register</button>
    </form>

</body>
</html>