@extends('layouts.app')

@section('title', 'Jadwalkan Sesi — Kebaya')

@section('content')
    <header class="dash-header">
      <div class="welcome-text">
        <h1>Jadwalkan Sesi Konseling</h1>
        <p>Atur waktu luangmu dan amankan ruang obrolan privat bersama konselor sebaya pilihanmu.</p>
      </div>
    </header>

    <div class="booking-layout-wrapper" style="display: flex; flex-direction: column; gap: 2rem; margin-top: 2rem;">
      
      {{-- ===== SATU CARD UTAMA: PROFIL, DESKRIPSI & GRAFIK DI BAWAHNYA ===== --}}
      <section class="counselor-profile-container" style="display: flex; flex-direction: column; gap: 2rem; background: #fff; padding: 2rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05);">
        
        <div class="profile-bio-side" style="display: flex; gap: 1.5rem; align-items: flex-start; width: 100%;">
          <div class="counselor-avatar-large" style="width: 80px; height: 80px; background: var(--sand); color: var(--brown); display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 600; font-size: 2rem; border: 3px solid var(--warm); flex-shrink: 0;">
            {{ $counselor->initials ?? 'CS' }} 
          </div>
          <div class="counselor-bio-details" style="flex: 1;">
            <span class="badge-specialization" style="background: var(--cream); color: var(--brown); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; border: 1px solid var(--warm);">
              {{ $counselor->specialization ?? 'Peer Counselor' }} 
            </span>
            <h2 style="color: var(--brown); margin: 0.5rem 0 0.5rem 0; font-size: 1.6rem;">{{ $counselor->name }}</h2> 
            <p class="counselor-description" style="color: var(--muted); font-size: 0.9rem; line-height: 1.5; margin: 0 0 1rem 0;">
              {{ $counselor->description ?? 'Belum ada deskripsi profil untuk konselor ini.' }} 
            </p>
            <div class="mini-meta-stats" style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
              <span class="meta-pill" style="display: flex; align-items: center; gap: 4px; background: rgba(0,0,0,0.02); padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.8rem; color: var(--mid); font-weight: 500;">
                <span class="material-symbols-rounded" style="font-size: 1rem;">verified</span> Peer Counselor
              </span>
              <span class="meta-pill" style="display: flex; align-items: center; gap: 4px; background: rgba(0,0,0,0.02); padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.8rem; color: var(--mid); font-weight: 500;">
                <span class="material-symbols-rounded" style="font-size: 1rem;">thumb_up</span> {{ $counselor->satisfaction ?? '95% Puas' }} 
              </span>
            </div>
          </div>
        </div>

        <div class="profile-chart-side" style="width: 100%; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 1.5rem;">
          <div class="chart-header-mini" style="margin-bottom: 1.25rem;">
            <h5 style="margin: 0; color: var(--brown); font-size: 1rem;">Statistik & Evaluasi Konselor</h5>
            <p style="margin: 0.15rem 0 0 0; color: var(--muted); font-size: 0.8rem;">Metrik penilaian riil dari sesi mahasiswa sebelumnya.</p>
          </div>
          
          <div class="charts-flex-container" style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <div class="chart-box" style="flex: 1; min-width: 250px; background: var(--cream); padding: 1rem; border-radius: 12px; border: 1px solid var(--warm);">
              <span style="font-size: 0.8rem; font-weight: 600; color: var(--brown); display: block; margin-bottom: 0.75rem; text-align: center;">Kategori Kasus</span>
              <div class="mini-chart-canvas-box" style="position: relative; height: 130px;">
                <canvas id="counselorPieChart"></canvas>
              </div>
            </div>

            <div class="chart-box" style="flex: 1; min-width: 250px; background: var(--cream); padding: 1rem; border-radius: 12px; border: 1px solid var(--warm);">
              <span style="font-size: 0.8rem; font-weight: 600; color: var(--brown); display: block; margin-bottom: 0.75rem; text-align: center;">Metrik Kepuasan</span>
              <div class="mini-chart-canvas-box" style="position: relative; height: 130px;">
                <canvas id="counselorColumnChart"></canvas>
              </div>
            </div>
          </div>
        </div>

      </section>

      {{-- BARIS BAWAH: FORMULIR RESERVASI --}}
      <section class="booking-form-container" style="background: #fff; padding: 2rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05);">
        <div class="booking-form-header" style="margin-bottom: 2rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 1rem;">
          <h3 style="color: var(--brown); margin: 0;">Formulir Reservasi Jadwal</h3>
          <p style="color: var(--muted); font-size: 0.85rem; margin-top: 0.25rem;">Lengkapi detail di bawah untuk mengamankan ruang obrolan privat Anda bersama {{ $counselor->name }}.</p>
        </div>
        <form action="{{ route('dashboard.booking.store') }}" method="POST" class="booking-interactive-form" style="display: flex; flex-direction: column; gap: 1.75rem;">
          @csrf
          <input type="hidden" name="counselor_id" value="{{ $counselor->id }}">

          <div class="form-group-wrapper">
              <label class="section-sub-title" style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: var(--text);">
                  Pilih Metode Pertemuan
              </label>
              <div class="method-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                  
                  <label class="method-custom-card">
                      <input type="radio" name="booking_method" value="chat" required class="hidden-radio" checked>
                      <div class="card-method-content">
                          <span class="material-symbols-rounded method-icon">chat_bubble</span>
                          <div class="method-details">
                              <h5>Chat Obrolan</h5>
                              <p>Konseling via text privat</p>
                          </div>
                      </div>
                  </label>

                  <label class="method-custom-card">
                      <input type="radio" name="booking_method" value="video" class="hidden-radio">
                      <div class="card-method-content">
                          <span class="material-symbols-rounded method-icon">video_call</span>
                          <div class="method-details">
                              <h5>Panggilan Video</h5>
                              <p>Tatap muka via media daring</p>
                          </div>
                      </div>
                  </label>

              </div>
          </div>

          <div class="form-group-wrapper">
              <label for="booking_date" class="section-sub-title" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                  Pilih Tanggal Sesi
              </label>
              <input type="date" id="booking_date" name="booking_date" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                    style="width: 100%; padding: 0.85rem 1.2rem; border-radius: 12px; border: 1px solid var(--warm); background: #fff; font-family: 'DM Sans', sans-serif;">
          </div>

          <div class="form-group-wrapper">
              <label class="section-sub-title" style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: var(--text);">
                  Pilih Jam Pertemuan yang Tersedia
              </label>
              <div class="time-chips-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 0.75rem;">
                  
                  @php
                      $available_times = ['09:00', '11:00', '14:00', '16:00'];
                  @endphp

                  @foreach($available_times as $time)
                      <label class="time-chip-item">
                          <input type="radio" name="booking_time" value="{{ $time }}" required class="hidden-radio" {{ $loop->first ? 'checked' : '' }}>
                          <span class="chip-time-text">{{ $time }}</span>
                      </label>
                  @endforeach

              </div>
          </div>

          <div class="form-group-wrapper">
              <label for="client_notes" class="section-sub-title" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                  Catatan Keluhan Awal (Opsional)
              </label>
              <textarea id="client_notes" name="client_notes" placeholder="Ceritakan sedikit kendala atau topik utama yang ingin kamu diskusikan bersama konselor..." 
                        style="width: 100%; min-height: 120px; padding: 1rem 1.2rem; border-radius: 12px; border: 1px solid var(--warm); background: #fff; font-family: 'DM Sans', sans-serif; resize: vertical;"></textarea>
          </div>

          <button type="submit" class="btn-dash-primary" style="width: 100%; padding: 1rem; border-radius: 30px; font-weight: 600; font-size: 1rem;">
              Konfirmasi & Jadwalkan Sesi
          </button>
        </form>
      </section>

    </div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // 1. INISIALISASI PIE CHART (Masalah yang Ditangani)
    const ctxPie = document.getElementById('counselorPieChart').getContext('2d');
    new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['Akademik', 'Pribadi', 'Karir'],
        datasets: [{
          data: @json($pieData),
          backgroundColor: ['#4b2e2b', '#a0522d', '#7a4a35'],
          borderWidth: 1,
          borderColor: '#fef9f3'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right',
            labels: {
              boxWidth: 8,
              font: { family: 'DM Sans', size: 10, weight: '500' },
              color: '#322214'
            }
          }
        }
      }
    });

    // 2. INISIALISASI COLUMN CHART (Metrik Kepuasan)
    const ctxColumn = document.getElementById('counselorColumnChart').getContext('2d');
    new Chart(ctxColumn, {
      type: 'bar',
      data: {
        labels: ['Nyaman', 'Dampak', 'Aman', 'Akses', 'Relasi'],
        datasets: [{
          data: @json($barData),
          backgroundColor: '#4b2e2b',
          hoverBackgroundColor: '#7a4a35',
          borderRadius: 3,
          barPercentage: 0.5
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: {
            min: 0,
            max: 5,
            ticks: { stepSize: 1, font: { family: 'DM Sans', size: 9 } },
            grid: { color: 'rgba(0,0,0,0.04)' }
          },
          x: {
            ticks: { font: { family: 'DM Sans', size: 9, weight: '500' } },
            grid: { display: false }
          }
        }
      }
    });

    // 3. LOGIKA INTERAKSI SUBMIT FORM & LOADING INDIKATOR
    document.querySelector('.booking-interactive-form').addEventListener('submit', function(e) {
      // e.preventDefault(); <--- PASTIKAN BARIS INI SUDAH DIHAPUS/DIKOMENTARI
      
      const submitBtn = document.querySelector('.btn-dash-primary');
      submitBtn.innerHTML = 'Memproses Reservasi Kampus...';
      submitBtn.style.opacity = '0.7';
      submitBtn.style.pointerEvents = 'none';
    });
  </script>
@endsection