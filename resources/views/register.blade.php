<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun — Kebaya</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  
  <!-- Gaya CSS Tambahan khusus untuk Slider dan Dinamis Form -->
  <style>
    /* Kontainer Utama Slider */
    .role-slider-container {
      display: flex;
      background: rgba(75, 46, 43, 0.06);
      padding: 4px;
      border-radius: 12px;
      position: relative;
      margin-bottom: 2rem;
      cursor: pointer;
      user-select: none;
    }

    /* Klip Background Yang Bergeser (Slider) */
    .role-slider-active-bg {
      position: absolute;
      top: 4px;
      left: 4px;
      width: calc(50% - 4px);
      height: calc(100% - 8px);
      background: #4b2e2b;
      border-radius: 9px;
      transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1;
    }

    /* Tombol Pilihan Peta */
    .role-tab-btn {
      flex: 1;
      text-align: center;
      padding: 0.65rem 0;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      font-weight: 600;
      color: #8c6239;
      z-index: 2;
      transition: color 0.3s ease;
    }

    /* Kondisi aktif ketika slider bergeser */
    .role-tab-btn.active-role {
      color: #fffefb;
    }

    /* Animasi smooth saat field konselor muncul */
    .counselor-only-fields {
      display: none;
      opacity: 0;
      transform: translateY(-8px);
      transition: all 0.3s ease;
    }

    .counselor-only-fields.show-fields {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>
<body class="auth-page-split">

  <div class="auth-split-left">
    <div class="left-branding-wrapper">
      <a href="{{route('landing')}}" class="split-logo">Kebaya</a>
      <h2 class="split-heading">Bergabunglah dengan komunitas kami untuk mendapatkan dan memberikan dukungan kesehatan mental yang bermakna.</h2>
      
      <div class="split-illustration-placeholder">
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
        <h1 class="split-title">Register</h1>
        <p id="register-subtitle" class="split-subtitle">Buat akun untuk memulai konsultasi</p>
      </div>

      <!-- SLIDER TOGGLE DI ATAS FORM -->
      <div class="role-slider-container" id="roleSlider">
        <div class="role-slider-active-bg" id="sliderBg"></div>
        <div class="role-tab-btn active-role" id="tabUser" onclick="switchRole('user')">Pengguna</div>
        <div class="role-tab-btn" id="tabCounselor" onclick="switchRole('counselor')">Konselor</div>
      </div>

      <!-- FORM UTAMA -->
      <form action="#" class="auth-form-modern" id="registerForm">
        <!-- Input tipe hidden untuk dikirim ke Laravel Backend nantinya (Default: user) -->
        <input type="hidden" name="role" id="roleInput" value="user">

        <div class="split-form-group">
          <label for="fullname">Nama Lengkap</label>
          <input type="text" id="fullname" name="name" placeholder="masukkan nama lengkap anda" required>
        </div>

        <div class="split-form-group">
          <label for="email">Email Utama</label>
          <input type="email" id="email" name="email" placeholder="masukkan email anda" required>
        </div>

        <div class="split-form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="masukkan kata sandi anda" required>
        </div>

        <div class="split-form-group">
          <label for="phone">Nomor Telepon</label>
          <input type="tel" id="phone" name="phone" placeholder="masukkan nomor telepon anda" required>
        </div>

        <!-- FIELD KHUSUS KONSELOR (DILINDUNGI CONTAINER DINAMIS) -->
        <div class="counselor-only-fields" id="counselorFields">
          <div class="split-form-group" style="margin-top: 1rem;">
            <label for="contact_phone">Nomor Kontak Darurat / Alternatif</label>
            <input type="tel" id="contact_phone" name="contact_phone" placeholder="masukkan nomor kontak kerja/darurat">
          </div>

          <div class="split-form-group">
            <label for="contact_email">Email Kontak Tambahan (Instansi)</label>
            <input type="email" id="contact_email" name="contact_email" placeholder="nama.konselor@instansi.com">
          </div>
        </div>

        <button type="submit" class="btn-split-submit" style="margin-top: 1.5rem;">Buat akun</button>
      </form>

      <div class="split-footer">
        Sudah punya akun? <a href="{{route('login')}}">Masuk di sini</a>
      </div>
    </div>
  </div>

  <!-- VANILLA JAVASCRIPT UNTUK LOGIKA SLIDER -->
  <script>
    function switchRole(role) {
      const sliderBg = document.getElementById('sliderBg');
      const tabUser = document.getElementById('tabUser');
      const tabCounselor = document.getElementById('tabCounselor');
      const subtitle = document.getElementById('register-subtitle');
      const counselorFields = document.getElementById('counselorFields');
      const roleInput = document.getElementById('roleInput');
      
      // Input Element Tambahan Dalam Form
      const contactPhone = document.getElementById('contact_phone');
      const contactEmail = document.getElementById('contact_email');

      if (role === 'user') {
        // Geser Background Slider ke Kiri
        sliderBg.style.left = '4px';
        
        // Atur Kelas Aktif Label Huruf
        tabUser.classList.add('active-role');
        tabCounselor.classList.remove('active-role');
        
        // Ubah Subtitle Teks info
        subtitle.innerText = 'Buat akun untuk memulai konsultasi';
        
        // Sembunyikan Inputan Tambahan Konselor
        counselorFields.classList.remove('show-fields');
        
        // Matikan fungsi "required" agar form user bisa dikirim tanpa isi data ini
        contactPhone.removeAttribute('required');
        contactEmail.removeAttribute('required');
        
        // Set Value Role untuk Backend Laravel
        roleInput.value = 'user';

      } else if (role === 'counselor') {
        // Geser Background Slider ke Kanan (Lebar 50% dikurangi padding)
        sliderBg.style.left = 'calc(50% - 0px)';
        
        // Atur Kelas Aktif Label Huruf
        tabCounselor.classList.add('active-role');
        tabUser.classList.remove('active-role');
        
        // Ubah Subtitle Teks info
        subtitle.innerText = 'Daftarkan diri Anda sebagai Konselor resmi';
        
        // Memunculkan Inputan Tambahan Konselor dengan transisi meluncur
        counselorFields.classList.add('show-fields');
        
        // Aktifkan fungsi "required" wajib isi khusus saat mode konselor aktif
        contactPhone.setAttribute('required', '');
        contactEmail.setAttribute('required', '');
        
        // Set Value Role untuk Backend Laravel
        roleInput.value = 'counselor';
      }
    }
  </script>
</body>
</html>