<!DOCTYPE html>
<html>
<head>
    <title>SMART TEST</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="container">
    <div class="card">

        <h1>SMART TEST</h1>
        <p>Login Mahasiswa</p>

        @if(session('error'))
            <p style="color:red;">
                {{ session('error') }}
            </p>
        @endif

        <form action="{{ route('login.process') }}" method="POST">

            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <button type="submit">
                LOGIN
            </button>

        </form>

        <a href="#">
            Belum punya akun?
        </a>

    </div>
</div>

</body>
</html>
