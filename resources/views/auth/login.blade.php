<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    <form method="POST" action="/login">
        @csrf

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

        <button type="submit">Login</button>
    </form>

</body>
</html>