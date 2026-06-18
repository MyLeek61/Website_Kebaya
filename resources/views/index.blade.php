<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kebaya — Konselor Sebaya</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<nav>
  <a href="#" class="nav-logo">Kebaya</a>
  <ul class="nav-links">
    <li><a href="#" class="active">Beranda</a></li>
    <li><a href="#counselors">Cari Konselor</a></li>
    <li><a href="#about">Tentang Kami</a></li>
  </ul>
  <div class="nav-actions">
    <a href="{{route('login')}}" class="btn-ghost">Masuk</a>
    <a href="{{route('register')}}" class="btn-primary">Daftar</a>
  </div>
</nav>

<!-- HERO -->
<section style="padding: 0;">
  <div class="hero">
    <div class="hero-left">
      <span class="hero-tag">✦ Konselor Sebaya Terpercaya</span>
      <h1 class="hero-title">Setiap Cerita Layak<br>Mendapatkan<br><em>Ruang Aman.</em></h1>
      <p class="hero-body">Bicara dengan Konselor Sebaya yang memahami duniamu tanpa menghakimi. Temukan ketenangan melalui percakapan yang tulus dan penuh empati.</p>
      <div class="hero-actions">
        <a href="#" class="btn-large primary">Mulai Percakapan</a>
        <a href="#why" class="btn-large secondary">Pelajari Lebih Lanjut</a>
      </div>
      <div class="hero-badge">Tersedia Sekarang — Kami ada untuk mendengarkan, bukan sekadar memberikan jawaban.</div>
    </div>
    <div class="hero-right">
      <div class="hero-right-inner">
        <div class="hero-card">
          <p>"Awalnya saya ragu untuk bercerita, tapi konselor saya membuat saya merasa didengarkan seutuhnya. Tidak ada penilaian, hanya empati."</p>
          <br>
          <strong style="font-size:0.85rem; color:var(--brown);">Maya R. — Mahasiswa</strong>
        </div>
        <div class="hero-stat">
          <div class="stat-icon">✓</div>
          <div>
            <div class="stat-number">5,000+</div>
            <div class="stat-label">Sesi Terbantu</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY -->
<section class="why" id="why">
  <div class="container">
    <div class="why-grid">
      <div>
        <div class="section-tag">Mengapa Berbeda</div>
        <h2 class="section-title">Mengapa Memilih Konselor Sebaya?</h2>
        <p class="section-body">Konselor Sebaya bukanlah sekadar layanan konsultasi biasa. Kami adalah komunitas individu yang dilatih secara profesional untuk memberikan dukungan emosional kepada sesama. Tanpa ada jarak hirarki, percakapan mengalir lebih alami.</p>
      </div>
      <div class="why-cards">
        <div class="why-card">
          <div class="why-card-num">01</div>
          <h3>Kesetaraan Pengalaman</h3>
          <p>Bicara dengan mereka yang mungkin pernah berada di posisi yang sama dengan Anda, menciptakan jembatan empati yang lebih kuat.</p>
        </div>
        <div class="why-card">
          <div class="why-card-num">02</div>
          <h3>Tersertifikasi</h3>
          <p>Setiap konselor kami melewati pelatihan intensif dukungan psikososial untuk memastikan keamanan dan kualitas dukungan.</p>
        </div>
        <div class="why-card">
          <div class="why-card-num">03</div>
          <h3>Aman & Rahasia</h3>
          <p>Privasi Anda adalah prioritas utama dalam setiap sesi. Semua percakapan dilindungi dengan enkripsi tingkat tinggi.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section id="how">
  <div class="container">
    <div style="text-align: center; margin-bottom: 1rem;">
      <div class="section-tag">Cara Kerja</div>
      <h2 class="section-title">Langkah Menuju Ketenangan</h2>
      <p class="section-body" style="margin: 0 auto;">Tiga langkah sederhana untuk memulai perjalanan kesehatan mental Anda hari ini.</p>
    </div>
    <div class="steps-grid">
      <div class="step">
        <div class="step-num">01</div>
        <h3>Pilih Konselor</h3>
        <p>Jelajahi profil konselor kami dan temukan yang paling beresonansi dengan cerita Anda.</p>
      </div>
      <div class="step">
        <div class="step-num">02</div>
        <h3>Atur Jadwal</h3>
        <p>Tentukan waktu yang paling nyaman untuk Anda, tanpa perlu menunggu antrean lama.</p>
      </div>
      <div class="step">
        <div class="step-num">03</div>
        <h3>Mulai Berbagi</h3>
        <p>Masuk ke ruang virtual yang privat dan mulailah perjalanan penyembuhan Anda.</p>
      </div>
    </div>
  </div>
</section>

<!-- COUNSELORS -->
<section class="counselors" id="counselors">
  <div class="container">
    <div class="counselors-header">
      <div>
        <div class="section-tag">Tim Kami</div>
        <h2 class="section-title">Kenali Konselor Kami</h2>
        <p class="section-body">Dukungan profesional dari mereka yang peduli.</p>
      </div>
      <a href="#" style="font-size:0.85rem; color:var(--mid); text-decoration:none;">Semua Konselor →</a>
    </div>
    <div class="counselors-grid">
      <div class="counselor-card">
        <div class="counselor-avatar">SA</div>
        <div class="counselor-name">Sarah Amalia</div>
        <div class="counselor-spec">Spesialis Kecemasan & Karir</div>
        <div class="counselor-tags">
          <span class="tag">Empati</span>
          <span class="tag">Solutif</span>
        </div>
        <p style="font-size:0.85rem;color:var(--muted);">Membantu mahasiswa dan profesional muda mengelola stres dan menemukan keseimbangan.</p>
        <div class="rating" style="margin-top:0.75rem;">★ 4.9</div>
        <a href="#" class="btn-link">Lihat Profil</a>
      </div>
      <div class="counselor-card">
        <div class="counselor-avatar">DP</div>
        <div class="counselor-name">Dimas Pratama</div>
        <div class="counselor-spec">Masalah Hubungan & Trauma</div>
        <div class="counselor-tags">
          <span class="tag">Pendengar</span>
          <span class="tag">Tenang</span>
        </div>
        <p style="font-size:0.85rem;color:var(--muted);">Berpengalaman mendampingi penyintas trauma dan masalah interpersonal dengan ruang bicara yang aman.</p>
        <div class="rating" style="margin-top:0.75rem;">★ 4.8</div>
        <a href="#" class="btn-link">Lihat Profil</a>
      </div>
      <div class="counselor-card">
        <div class="counselor-avatar">NW</div>
        <div class="counselor-name">Nina Wijaya</div>
        <div class="counselor-spec">Self-Harm & Depresi</div>
        <div class="counselor-tags">
          <span class="tag">Sabar</span>
          <span class="tag">Inklusif</span>
        </div>
        <p style="font-size:0.85rem;color:var(--muted);">Membangun ketahanan mental melalui seni ekspresi diri dan mindfulness.</p>
        <div class="rating" style="margin-top:0.75rem;">★ 5.0</div>
        <a href="#" class="btn-link">Lihat Profil</a>
      </div>
      <div class="counselor-card">
        <div class="counselor-avatar">RH</div>
        <div class="counselor-name">Rizky Hakim</div>
        <div class="counselor-spec">Manajemen Waktu & Akademik</div>
        <div class="counselor-tags">
          <span class="tag">Metodik</span>
          <span class="tag">Efektif</span>
        </div>
        <p style="font-size:0.85rem;color:var(--muted);">Membantu navigasi beban akademik dan kecemasan masa depan melalui teknik produktivitas yang sehat.</p>
        <div class="rating" style="margin-top:0.75rem;">★ 4.7</div>
        <a href="#" class="btn-link">Lihat Profil</a>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials">
  <div class="container">
    <div class="section-tag" style="text-align:center;">Kisah Nyata</div>
    <h2 class="section-title" style="text-align:center;">Kisah dari Teman-teman Kami</h2>
    <p class="section-body" style="margin:0 auto;text-align:center;">Ribuan orang telah menemukan ketenangan dan ruang aman bersama Kebaya.</p>
    <div class="testimonials-grid">
      <div class="testimonial">
        <p class="testimonial-text">"Awalnya saya ragu untuk bercerita, tapi konselor saya membuat saya merasa didengarkan seutuhnya. Tidak ada penilaian, hanya empati."</p>
        <div class="testimonial-author">
          <div class="author-avatar">M</div>
          <div>
            <div class="author-name">Maya R.</div>
            <div class="author-role">Mahasiswa</div>
          </div>
        </div>
      </div>
      <div class="testimonial">
        <p class="testimonial-text">"Platform ini membantu saya melewati masa tersulit dalam karir saya. Sangat menenangkan berbicara dengan seseorang yang seusia."</p>
        <div class="testimonial-author">
          <div class="author-avatar">A</div>
          <div>
            <div class="author-name">Adit P.</div>
            <div class="author-role">Creative Designer</div>
          </div>
        </div>
      </div>
      <div class="testimonial">
        <p class="testimonial-text">"Terima kasih Konselor Sebaya. Sekarang saya punya cara yang lebih sehat untuk mengelola stres saya sehari-hari."</p>
        <div class="testimonial-author">
          <div class="author-avatar">S</div>
          <div>
            <div class="author-name">Siska W.</div>
            <div class="author-role">Entrepreneur</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <div class="container">
    <h2 class="section-title">Siap untuk Memulai Perjalananmu?</h2>
    <p class="section-body">Ruang aman Anda sudah menanti. Bergabunglah dengan ribuan orang lainnya yang telah memprioritaskan kesehatan mental mereka.</p>
    <a href="register.html" class="btn-cta">Daftar Sekarang</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div>
      <div class="footer-brand">Kebaya</div>
      <p class="footer-tagline">Menghadirkan Ruang Aman untuk Setiap Cerita. Dibuat dengan ♥ untuk kesehatan mental Indonesia.</p>
    </div>
    <div class="footer-col">
      <h4>Navigasi</h4>
      <ul>
        <li><a href="#">Cari Konselor</a></li>
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#">Blog Artikel</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Dukungan</h4>
      <ul>
        <li><a href="#">Pusat Bantuan</a></li>
        <li><a href="#">Syarat & Ketentuan</a></li>
        <li><a href="#">Kebijakan Privasi</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Hubungi Kami</h4>
      <ul>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Twitter / X</a></li>
        <li><a href="#">Email</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    © 2024 Kebaya Peer Counseling. A digital sanctuary for connection.
  </div>
</footer>

</body>
</html>