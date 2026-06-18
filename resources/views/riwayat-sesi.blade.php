@extends('layouts.app')

@section('title', 'Riwayat Sesi — Kebaya')

@section('content')
    <header class="dash-header">
      <div class="welcome-text">
        <h1>Riwayat Sesi Konseling 📜</h1>
        <p>Lihat kembali catatan, rekomendasi, dan perkembangan kesehatan mentalmu dari sesi terdahulu.</p>
      </div>
    </header>

    <div class="session-history-container" style="display: flex; flex-direction: column; gap: 1.5rem; margin-top: 1.5rem;">
      
      {{-- ===== SESI 1: SELESAI & BUTUH ULASAN ===== --}}
      <div class="session-history-card" style="background: #fff; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05);">
        <div class="session-card-meta" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1.25rem;">
          <div class="counselor-meta-group" style="display: flex; align-items: center; gap: 1rem;">
            <div class="mini-avatar-initials" style="width: 44px; height: 44px; background: var(--sand); color: var(--brown); display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 600; font-size: 0.95rem;">
              FA
            </div>
            <div>
              <h4 style="margin: 0; color: var(--brown); font-size: 1.1rem;">Fahri Alamsyah, S.Psi.</h4>
              <p class="session-date-type" style="margin: 0.15rem 0 0 0; font-size: 0.85rem; color: var(--muted);">Hari Ini • Live Chat • 16:00 WIB</p>
            </div>
          </div>
          <span class="status-pill-success" style="background: rgba(46, 125, 50, 0.1); color: var(--green); padding: 0.35rem 0.85rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
            Sesi Selesai
          </span>
        </div>

        <div class="session-card-body" style="margin-bottom: 1.25rem; border-left: 3px solid var(--warm); padding-left: 1rem;">
          <h5 style="margin: 0 0 0.35rem 0; color: var(--brown); font-size: 0.9rem; font-weight: 600;">Catatan & Rekomendasi Konselor:</h5>
          <p style="margin: 0; font-size: 0.9rem; color: var(--muted); line-height: 1.5; font-style: italic;">
            "Klien menunjukkan perkembangan kecemasan yang cukup tinggi terkait penyesuaian iklim akademik semester akhir. Disarankan untuk mempraktikkan teknik pernapasan kotak (box breathing) secara rutin sebelum belajar dan beristirahat yang cukup."
          </p>
        </div>

        <div class="session-card-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1rem;">
          <div class="user-given-rating" style="display: flex; align-items: center; gap: 6px; font-size: 0.85rem; color: var(--muted);">
            <span class="material-symbols-rounded" style="color: #ffb703; font-size: 1.2rem;">star_half</span>
            <span>Sesi ini belum dievaluasi olehmu</span>
          </div>
          <button class="btn-dash-primary" style="width: auto; padding: 0.5rem 1.25rem; font-size: 0.85rem;">Beri Ulasan Bintang</button>
        </div>
      </div>

      {{-- ===== SESI 2: RUJUKAN ===== --}}
      <div class="session-history-card" style="background: #fff; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05);">
        <div class="session-card-meta" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1.25rem;">
          <div class="counselor-meta-group" style="display: flex; align-items: center; gap: 1rem;">
            <div class="mini-avatar-initials" style="width: 44px; height: 44px; background: var(--sand); color: var(--brown); display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 600; font-size: 0.95rem;">
              SA
            </div>
            <div>
              <h4 style="margin: 0; color: var(--brown); font-size: 1.1rem;">Salsa Amalia, S.Psi.</h4>
              <p class="session-date-type" style="margin: 0.15rem 0 0 0; font-size: 0.85rem; color: var(--muted);">20 Mei 2026 • Live Chat • 14:00 WIB</p>
            </div>
          </div>
          <span class="status-pill-warning" style="background: rgba(214, 40, 40, 0.1); color: #d62828; padding: 0.35rem 0.85rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
            Membutuhkan Rujukan
          </span>
        </div>

        <div class="session-card-body" style="margin-bottom: 1.25rem; border-left: 3px solid #d62828; padding-left: 1rem;">
          <h5 style="margin: 0 0 0.35rem 0; color: var(--brown); font-size: 0.9rem; font-weight: 600;">Catatan & Rekomendasi Konselor:</h5>
          <p style="margin: 0; font-size: 0.9rem; color: var(--muted); line-height: 1.5; font-style: italic;">
            "Gejala kejenuhan akademik yang bercampur dengan kendala fisik/kelelahan tidur ekstrem kronis. Sesi dihentikan untuk diarahkan berdiskusi lebih lanjut dengan Psikolog Klinis profesional di Pusat Kesehatan Mahasiswa Universitas."
          </p>
        </div>

        <div class="session-card-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1rem;">
          <div class="user-given-rating" style="display: flex; align-items: center; gap: 6px; font-size: 0.85rem; color: var(--muted);">
            <span class="material-symbols-rounded" style="color: #ffb703; font-size: 1.2rem; font-variant-numeric: normal;">star</span>
            <span class="rating-text">Kamu memberikan ulasan: <strong>4 / 5</strong></span>
          </div>
          <a href="{{ route('dashboard.konsultasi') }}" class="btn-history-action-secondary" style="display: inline-block; padding: 0.5rem 1.25rem; font-size: 0.85rem; font-weight: 600; color: var(--mid); border: 1px solid var(--warm); border-radius: 8px; text-decoration: none; transition: background 0.2s;">
            Jadwalkan Sesi Baru
          </a>
        </div>
      </div>

    </div>
@endsection