<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk — Kebaya</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/style.css') }}">
</head>
<body class="auth-page-split">

  <div class="auth-split-left">
    <div class="left-branding-wrapper">
      <a href="{{ route('landing') }}" class="split-logo">Kebaya</a>
      <h2 class="split-heading">Kembali ke ruang amanmu. Masuk untuk melanjutkan obrolan penuh empati dengan konselor sebaya pilihanmu.</h2>
      
      <div class="split-illustration-placeholder">
        <img src="" alt="">
        <div class="floating-pill-stat">
          <div class="pill-icon">♥</div>
          <div>
            <div class="pill-number">5,000+</div>
            <div class="pill-label">Sesi Terbantu</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="auth-split-right">
    <div class="auth-card-floating">
      <div class="auth-card-header">
        <h1 class="split-title">Log In</h1>
        <p class="split-subtitle">Masuk ke dalam akun yang sudah ada</p>
      </div>

      <form action="{{ route('login.store') }}" method="POST" class="auth-form-modern">
        @csrf 

        @if ($errors->any())
            <div style="color: #7a4a35; background-color: #f2e0cd; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; border-left: 4px solid var(--accent, #a0522d);">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="split-form-group">
          <label for="email">Nama / Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="masukkan nama atau email anda" required>
        </div>

        <div class="split-form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="masukkan kata sandi anda" required>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; font-size: 0.85rem; color: #6b4e3d;">
          <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
              <input type="checkbox" name="remember" style="accent-color: #7a4a35;"> Ingat Saya
          </label>
          <a href="#" style="color: #7a4a35; text-decoration: none; font-weight: 500;">Lupa Sandi?</a>
        </div>

        <button type="submit" class="btn-split-submit">Masuk</button>
      </form>

    </div>
  </div>

</body>
</html>