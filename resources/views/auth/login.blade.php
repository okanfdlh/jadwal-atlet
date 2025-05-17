<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login Pengguna</h2>

    @if (session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
