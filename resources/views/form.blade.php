<!DOCTYPE html>
<html>
<head>
    <title>Form Laravel</title>
</head>
<body>

    <h1>Form Data User</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/submit" method="POST">
        @csrf

        <label for="name">Nama:</label>
        <input type="text" name="name" id="name">

        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <br><br>

        <label for="password_confirmation">Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation">

        <br><br>

        <button type="submit">Kirim</button>
    </form>

</body>
</html>