<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <h3 class="mb-4 text-center">Login</h3>

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
    </form>

    <!-- Link ke halaman registrasi -->
    <div class="text-center">
        <p>Belum punya akun? <a href="{{ route('register') }}" class="btn btn-outline-secondary">Daftar Sekarang</a></p>
    </div>
</div>
</body>
</html>
