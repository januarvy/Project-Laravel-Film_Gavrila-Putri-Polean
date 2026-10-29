<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - OneMovies</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: "Segoe UI", Arial, sans-serif; background: #191927; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
    .box { background: #fff; padding: 35px; border-radius: 8px; width: 340px; }
    .box h1 { font-size: 22px; color: #191927; margin-bottom: 5px; }
    .box h1 span { color: #03a9f4; }
    .box p { font-size: 13px; color: #888; margin-bottom: 20px; }
    input { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; margin-bottom: 12px; }
    button { width: 100%; padding: 10px; background: #03a9f4; color: #fff; border: none; border-radius: 4px; font-size: 15px; cursor: pointer; }
    button:hover { background: #0288d1; }
    .err { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; padding: 10px; border-radius: 4px; margin-bottom: 12px; font-size: 13px; }
    .home { display: block; text-align: center; margin-top: 15px; font-size: 13px; color: #03a9f4; text-decoration: none; }
  </style>
</head>
<body>
  <div class="box">
    <h1>One<span>Movies</span> Admin</h1>
    <p>Halaman Login</p>
    @if ($errors->any())
      <div class="err">{{ $errors->first('login') ?: $errors->first() }}</div>
    @endif
    <form action="{{ route('login') }}" method="post">
      @csrf
      <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}">
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <a class="home" href="{{ route('home') }}">&laquo; Kembali ke Beranda</a>
  </div>
</body>
</html>
