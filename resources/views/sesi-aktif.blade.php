@extends('layouts.app')

@section('title', 'Sesi Berlangsung — Kebaya')

@section('content')
  <style>
    /* CSS Kustom Halaman Sesi Aktif */
    .session-container-box {
      background: #fff;
      border-radius: 20px;
      padding: 2.5rem;
      border: 1px solid rgba(75, 46, 43, 0.06);
      margin-top: 1.5rem;
    }
    .session-status-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      background: #e8f5e9;
      color: #1b5e20;
      padding: 0.45rem 1rem;
      border-radius: 30px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .session-title-text {
      font-family: 'DM Serif Display', serif;
      color: var(--brown);
      font-size: 2.2rem;
      margin-top: 1rem;
      margin-bottom: 0.5rem;
    }
    .session-subtitle-text {
      color: var(--muted);
      font-size: 0.95rem;
      margin-bottom: 2.5rem;
    }
    .session-main-layout {
      display: grid;
      grid-template-columns: 1fr;
      gap: 3rem;
    }
    @media (min-width: 992px) {
      .session-main-layout {
        grid-template-columns: 1.4fr 1fr;
      }
    }
    
    /* Kartu Profil Konselor di Sebelah Kanan */
    .counselor-profile-card {
      background: #fef9f3;
      border: 1px solid #e4d2be;
      padding: 1.5rem;
      border-radius: 16px;
      margin-bottom: 2rem;
    }
    .counselor-header-info {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      border-bottom: 1px dashed #e4d2be;
      padding-bottom: 1rem;
      margin-bottom: 1rem;
    }
    .counselor-avatar-large {
      width: 56px;
      height: 56px;
      background: var(--brown);
      color: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      font-weight: 600;
      flex-shrink: 0;
    }
    .counselor-meta-details h4 {
      margin: 0;
      font-family: 'DM Serif Display', serif;
      font-size: 1.2rem;
      color: var(--text);
    }
    .counselor-meta-details p {
      margin: 0;
      font-size: 0.8rem;
      color: var(--muted);
      margin-top: 0.15rem;
    }
    
    /* Detail Kontak Tambahan */
    .counselor-contact-list {
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
    }
    .contact-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      color: var(--text);
    }
    .contact-item span {
      font-size: 1.1rem;
      color: var(--brown);
    }

    .detail-section-block {
      margin-bottom: 2rem;
    }
    .detail-section-block h5 {
      font-size: 0.85rem;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.6rem;
    }
    .detail-section-block p {
      margin: 0;
      color: var(--text);
      line-height: 1.6;
      font-size: 1rem;
    }
    .channel-list-wrapper {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .channel-item-box {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1.25rem;
      background: #fbfbfb;
      border: 1px solid rgba(0,0,0,0.06);
      border-radius: 12px;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s, border-color 0.2s;
    }
    .channel-item-box:hover {
      transform: translateY(-2px);
      border-color: var(--mid);
    }
    .channel-icon {
      font-size: 1.8rem;
      color: var(--brown);
    }
    .channel-meta h5 {
      margin: 0;
      font-size: 0.95rem;
      color: var(--text);
      font-weight: 600;
    }
    .channel-meta p {
      margin: 0;
      font-size: 0.8rem;
      color: var(--muted);
      margin-top: 0.15rem;
    }
    .btn-finish-session {
      background: var(--brown);
      color: #fff;
      border: none;
      padding: 0.85rem 1.8rem;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 1rem;
      transition: background 0.2s;
    }
    .btn-finish-session:hover {
      background: var(--mid);
    }
  </style>

  <div class="session-container-box">
    <div class="session-status-badge">
      <span class="material-symbols-rounded" style="font-size: 1.1rem; color: #2e7d32;">fiber_manual_record</span>
      Sesi Konseling Aktif Berlangsung
    </div>

    <h1 class="session-title-text">Bimbingan Sedang Berjalan</h1>
    <p class="session-subtitle-text">Silakan gunakan media interaksi yang tersedia untuk melakukan sesi bimbingan kesehatan mental.</p>

    <div class="session-main-layout">
      
      <div class="session-left-content">
        
        <div class="detail-section-block">
          <h5>Identitas Mahasiswa Bimbingan</h5>
          <p style="font-size: 1.1rem; font-weight: 600; color: var(--text);">
            {{ $booking->user->name }}
          </p>
        </div>

        <div class="detail-section-block">
          <h5>Waktu Penjadwalan Sesi</h5>
          <p>
            <span class="material-symbols-rounded" style="font-size: 1.2rem; vertical-align: middle; margin-right: 0.3rem; color: var(--brown);">calendar_month</span>
            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }} • <strong>{{ $booking->booking_time }} WIB</strong>
          </p>
        </div>

        <div class="detail-section-block">
          <h5>Catatan Deskripsi Masalah</h5>
          <p style="background: #fafafa; border-left: 4px solid var(--brown); padding: 1.25rem; border-radius: 0 12px 12px 0; font-style: italic; color: #4a4a4a;">
            "{{ $booking->notes ?? 'Tidak ada catatan keluhan tertulis tambahan.' }}"
          </p>
        </div>
        @if(Auth::user()->role === 'counselor')
          <div style="margin-top: 3rem; border-top: 1px solid rgba(0,0,0,0.06); padding-top: 1.5rem;">
            @if($booking->status === 'sesi aktif')
              <form action="{{ route('dashboard.booking.finish', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah sesi bimbingan ini telah benar-benar selesai dilakukan?')">
                @csrf
                <button type="submit" class="btn-finish-session">
                  <span class="material-symbols-rounded">check_circle</span>
                  Selesaikan Sesi Konseling
                </button>
              </form>
            @else
              <div style="color: #2e7d32; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                <span class="material-symbols-rounded">task_alt</span> Sesi Ini Telah Berhasil Diselesaikan
              </div>
            @endif
          </div>
        @endif
      </div>

      <div class="session-right-content">
        
        <h5>Konselor Pendamping</h5>
          <div class="counselor-profile-card">
            <div class="counselor-header-info">
              <div class="counselor-avatar-large">
                {{ strtoupper(substr($booking->counselor->user->name ?? $booking->counselor->name ?? 'K', 0, 2)) }}
              </div>
              <div class="counselor-meta-details">
                <h4>{{ $booking->counselor->user->name ?? $booking->counselor->name ?? 'Konselor Kebaya' }}</h4>
                <p>Metode Sesi: <strong style="text-transform: uppercase;">{{ $booking->booking_method }}</strong></p>
              </div>
            </div>
            
            <div class="counselor-contact-list">
              <div class="contact-item">
                <span class="material-symbols-rounded">call</span>
                <span>{{ $booking->counselor->user->phone ?? 'Nomor tidak tersedia' }}</span>
              </div>
              <div class="contact-item">
                <span class="material-symbols-rounded">mail</span>
                <span>{{ $booking->counselor->user->email ?? 'Email tidak tersedia' }}</span>
              </div>
            </div>
          </div>

        <div class="detail-section-block">
          <h5>Media Komunikasi Utama</h5>
          <p style="font-size: 0.85rem; margin-bottom: 1.25rem; color: var(--muted);">Gunakan tautan di bawah ini untuk terhubung langsung ke ruang konsultasi:</p>
          
          <div class="channel-list-wrapper">
            @if($booking->booking_method === 'chat')
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->counselor->user->phone ?? '') }}" target="_blank" class="channel-item-box">
                <span class="material-symbols-rounded channel-icon">chat</span>
                <div class="channel-meta">
                  <h5>Hubungi via WhatsApp Chat</h5>
                  <p>Mulai diskusi bimbingan teks instan</p>
                </div>
              </a>
            @else
              <a href="https://meet.google.com" target="_blank" class="channel-item-box">
                <span class="material-symbols-rounded channel-icon">video_call</span>
                <div class="channel-meta">
                  <h5>Gabung via Google Meet</h5>
                  <p>Klik untuk memulai sesi tatap muka</p>
                </div>
              </a>
            @endif

            <div class="channel-item-box" style="cursor: default; background: #fff8f8; border-color: rgba(255,0,0,0.05);">
              <span class="material-symbols-rounded channel-icon" style="color: #c62828;">gavel</span>
              <div class="channel-meta">
                <h5>Aturan Etika Sanctuary</h5>
                <p>Harap jaga kerahasiaan identitas dan privasi seluruh obrolan klien.</p>
              </div>
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </div>
@endsection