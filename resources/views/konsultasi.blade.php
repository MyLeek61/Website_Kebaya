@extends('layouts.app')

@section('title', 'Cari Konselor — Kebaya')

@section('content')
    <header class="dash-header">
      <div class="welcome-text">
        <h1>Cari Konselor Sebaya</h1>
        <p>Temukan ruang amanmu bersama teman cerita yang tepat, responsif, dan penuh empati.</p>
      </div>
    </header>

    <div class="dash-grid">

      @forelse($counselors as $counselor)
        {{-- ===== MODERN COUNSELOR CARD ===== --}}
        <div class="counselor-card-modern">
          <div class="counselor-card-top">
            <span class="badge badge-online">● Online</span>
            <div class="counselor-avatar-large">
              {{-- Mengambil inisial atau 2 huruf pertama dari nama konselor --}}
              {{ strtoupper(substr($counselor->name, 0, 2)) }}
            </div>
          </div>
          <div class="counselor-card-info">
            <h3>{{ $counselor->name }}</h3>
            
            {{-- Mengubah Fakultas Pilihan menjadi Spesialisasi Konselor secara dinamis --}}
            <p class="counselor-faculty" style="color: var(--accent); font-weight: 600; font-size: 0.85rem;">
              {{ $counselor->specialization ?? 'Peer Counselor' }}
            </p>
            
            <div class="counselor-rating">
              <span class="material-symbols-rounded star-icon">star</span>
              <span class="rating-value">{{ $counselor->satisfaction ?? '95% Puas' }}</span>
              <span class="rating-count">(Sesi Aktif)</span>
            </div>
            
            {{-- Mengubah info nomor telepon menjadi deskripsi/bio konselor --}}
            <p class="counselor-bio" style="margin-top: 0.75rem; line-height: 1.5; color: var(--muted); font-size: 0.85rem;">
              {{ $counselor->description ?? 'Belum ada deskripsi profil untuk konselor ini.' }}
            </p>
          </div>
          
          <a href="{{ route('dashboard.booking', ['counselor_id' => $counselor->id]) }}" class="btn-book-counselor" style="text-decoration: none; text-align: center; display: block;">
            Jadwalkan Sesi
        </a>
        </div>
      @empty
        {{-- Kondisi Jika Belum Ada Konselor di Database --}}
        <div class="dash-card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
          <span class="material-symbols-rounded" style="font-size: 3rem; color: var(--muted);">group_off</span>
          <h3 style="margin-top: 1rem; color: var(--brown);">Belum Ada Konselor Tersedia</h3>
          <p style="color: var(--muted); font-size: 0.9rem;">Saat ini belum ada data konselor yang terdaftar di dalam sistem.</p>
        </div>
      @endforelse

    </div>
@endsection