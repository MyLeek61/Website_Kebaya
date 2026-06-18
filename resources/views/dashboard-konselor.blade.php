@extends('layouts.app')

@section('title', 'Dashboard Konselor — Kebaya')

@section('content')
  <style>
    /* CSS Kustom List Tabel Manajemen Booking */
    .management-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
      margin-top: 2rem;
      margin-bottom: 2rem;
    }
    @media (min-width: 992px) {
      .management-grid {
        grid-template-columns: 1fr 1fr;
      }
    }
    .manage-card {
      background: #fff;
      padding: 1.5rem;
      border-radius: 16px;
      border: 1px solid rgba(75, 46, 43, 0.06);
      display: flex;
      flex-direction: column;
    }
    .manage-card h3 {
      font-family: 'DM Serif Display', serif;
      color: var(--brown);
      font-size: 1.25rem;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .booking-list-wrapper {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      max-height: 380px;
      overflow-y: auto;
      padding-right: 0.25rem;
    }
    .booking-item-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
      background: #fef9f3;
      border: 1px solid #e4d2be;
      border-radius: 12px;
    }
    .student-info-box {
      display: flex;
      align-items: center;
      gap: 0.85rem;
    }
    .student-avatar-circle {
      width: 42px;
      height: 42px;
      background: var(--sand);
      color: var(--brown);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 0.9rem;
    }
    .student-details h4 {
      margin: 0;
      font-size: 0.95rem;
      color: var(--text);
      font-weight: 600;
    }
    .student-details p {
      margin: 0;
      font-size: 0.75rem;
      color: var(--muted);
      display: flex;
      align-items: center;
      gap: 0.3rem;
      margin-top: 0.15rem;
    }
    .action-btn-group {
      display: flex;
      gap: 0.5rem;
    }
    .btn-action-approve {
      background: var(--brown);
      color: #fff;
      border: none;
      padding: 0.45rem 0.85rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-action-approve:hover { background: var(--mid); }
    
    .session-badge-method {
      padding: 0.35rem 0.75rem;
      border-radius: 15px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
    }
    .badge-chat { background: #e3f2fd; color: #0d47a1; }
    .badge-video { background: #e8f5e9; color: #1b5e20; }
    
    .empty-state-text {
      text-align: center;
      color: var(--muted);
      font-size: 0.85rem;
      padding: 2rem 0;
    }

    /* ================= CSS MODAL PRATINJAU ================= */
    .custom-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }
    .custom-modal-overlay.active {
      opacity: 1;
      pointer-events: auto;
    }
    .custom-modal-card {
      background: #fff;
      width: 100%;
      max-width: 500px;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transform: translateY(-20px);
      transition: transform 0.3s ease;
    }
    .custom-modal-overlay.active .custom-modal-card {
      transform: translateY(0);
    }
    .modal-header-box {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid rgba(0,0,0,0.06);
      padding-bottom: 1rem;
      margin-bottom: 1.5rem;
    }
    .modal-header-box h3 {
      font-family: 'DM Serif Display', serif;
      color: var(--brown);
      margin: 0;
      font-size: 1.4rem;
    }
    .btn-close-modal {
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
    }
    .modal-info-group {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 2rem;
    }
    .info-row-item {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }
    .info-row-item label {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .info-row-item p {
      margin: 0;
      font-size: 1rem;
      color: var(--text);
      font-weight: 500;
    }
    .note-box {
      background: #fbfbfb;
      border: 1px dashed #e4d2be;
      padding: 0.85rem;
      border-radius: 8px;
      font-style: italic;
    }
    .modal-action-footer {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
    }
    .btn-modal-reject {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 0.6rem 1.2rem;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
    }
    .btn-modal-accept {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 0.6rem 1.2rem;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
    }
    
    /* Layout Grafik */
    .charts-grid-layout { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem; }
    .chart-card-item { background: #fff; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(75, 46, 43, 0.06); }
    .chart-card-item h3 { font-family: 'DM Serif Display', serif; color: var(--brown); font-size: 1.15rem; margin-bottom: 0.25rem; }
    .chart-card-item p { font-size: 0.8rem; color: var(--muted); margin-bottom: 1.25rem; }
    .chart-canvas-box { position: relative; width: 100%; height: 220px; }
  </style>

  <header class="dash-header">
    <div class="welcome-text">
      <h1>Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
      <p>Panel peninjauan statistik performa bimbingan dan pemantauan kategori sebaran keluhan mahasiswa.</p>
    </div>
  </header>
  <form id="accept-booking-form" method="POST" style="display: none;">
      @csrf
  </form>

  <form id="reject-booking-form" method="POST" style="display: none;">
      @csrf
      @method('DELETE')
  </form>

  <div class="management-grid">
    
    <div class="manage-card">
      <h3>
        <span class="material-symbols-rounded" style="color: #b57c1e;">gavel</span>
        Butuh Persetujuan Konfirmasi
      </h3>
      <div class="booking-list-wrapper">
        @forelse($pendingBookings as $booking)
          <div class="booking-item-row">
            <div class="student-info-box">
              <div class="student-avatar-circle">
                {{ strtoupper(substr($booking->user->name, 0, 2)) }}
              </div>
              <div class="student-details">
                <h4>{{ $booking->user->name }}</h4>
                <p>
                  <span class="material-symbols-rounded" style="font-size: 0.9rem;">calendar_month</span>
                  {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }} • {{ $booking->booking_time }}
                </p>
              </div>
            </div>
            <div class="action-btn-group">
              <button class="btn-action-approve" 
                      onclick="openPreviewModal('{{ $booking->user->name }}', '{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}', '{{ $booking->booking_time }}', '{{ $booking->booking_method }}', '{{ $booking->notes ?? 'Tidak ada catatan tambahan.' }}', '{{ $booking->id }}')">
                Tinjau
              </button>
            </div>
          </div>
        @empty
          <div class="empty-state-text">
            <span class="material-symbols-rounded" style="font-size: 2rem; display:block; margin-bottom: 0.5rem; color: #ccc;">assignment_turned_in</span>
            Tidak ada permintaan konsultasi yang tertunda.
          </div>
        @endforelse
      </div>
    </div>

    <div class="manage-card">
      <h3>
        <span class="material-symbols-rounded" style="color: #1b5e20;">event_available</span>
        Jadwal Sesi yang Akan Datang
      </h3>
      <div class="booking-list-wrapper">
        @forelse($upcomingSessions as $session)
          <div class="booking-item-row" style="background: #fbfbfb; border-color: rgba(0,0,0,0.08);">
            <div class="student-info-box">
              <div class="student-avatar-circle" style="background: #e4d2be;">
                {{ strtoupper(substr($session->user->name, 0, 2)) }}
              </div>
              <div class="student-details">
                <h4>{{ $session->user->name }}</h4>
                <p>
                  <span class="material-symbols-rounded" style="font-size: 0.9rem;">schedule</span>
                  {{ \Carbon\Carbon::parse($session->booking_date)->translatedFormat('d M Y') }} — <strong>{{ $session->booking_time }}</strong>
                </p>
              </div>
            </div>
            <div>
              <span class="session-badge-method badge-{{ $session->booking_method }}">
                {{ $session->booking_method }}
              </span>
            </div>
          </div>
        @empty
          <div class="empty-state-text">
            <span class="material-symbols-rounded" style="font-size: 2rem; display:block; margin-bottom: 0.5rem; color: #ccc;">calendar_today</span>
            Belum ada jadwal sesi terdekat yang terkonfirmasi.
          </div>
        @endforelse
      </div>
    </div>
  </div>

  <div class="charts-grid-layout">
    <div class="chart-card-item">
      <h3>Metrik Kepuasan Sesi</h3>
      <p>Rata-rata penilaian kepuasan pelayanan bimbingan dari skala 1-5.</p>
      <div class="chart-canvas-box">
        <canvas id="satisfactionBarChart"></canvas>
      </div>
    </div>

    <div class="chart-card-item">
      <h3>Sebaran Kategori Keluhan</h3>
      <p>Persentase topik permasalahan yang paling sering dikonsultasikan.</p>
      <div class="chart-canvas-box" style="height: 200px; margin-top: 10px;">
        <canvas id="pieCategoryChart"></canvas>
      </div>
    </div>
  </div>

  <div class="custom-modal-overlay" id="previewModal">
    <div class="custom-modal-card">
      <div class="modal-header-box">
        <h3>Pratinjau Reservasi</h3>
        <button class="btn-close-modal" onclick="closePreviewModal()">
          <span class="material-symbols-rounded">close</span>
        </button>
      </div>
      
      <div class="modal-info-group">
        <div class="info-row-item">
          <label>Nama Mahasiswa</label>
          <p id="modalStudentName">-</p>
        </div>
        <div class="info-row-item">
          <label>Jadwal Konsultasi</label>
          <p id="modalBookingSchedule">-</p>
        </div>
        <div class="info-row-item">
          <label>Metode Konsultasi</label>
          <p id="modalBookingMethod">-</p>
        </div>
        <div class="info-row-item">
          <label>Catatan Keluhan</label>
          <p id="modalBookingNotes" class="note-box">-</p>
        </div>
      </div>

      <div class="modal-action-footer">
        <button class="btn-modal-reject" onclick="handleAction('tolak')">Tolak</button>
        <button class="btn-modal-accept" onclick="handleAction('terima')">Terima</button>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    let activeBookingId = null;

    // Fungsi membuka modal dan mengisi konten data secara dinamis
    function openPreviewModal(name, date, time, method, notes, id) {
      document.getElementById('modalStudentName').innerText = name;
      document.getElementById('modalBookingSchedule').innerText = date + ' • ' + time;
      document.getElementById('modalBookingMethod').innerText = method.toUpperCase();
      document.getElementById('modalBookingNotes').innerText = notes;
      activeBookingId = id;
      
      document.getElementById('previewModal').classList.add('active');
    }

    // Fungsi menutup modal
    function closePreviewModal() {
      document.getElementById('previewModal').classList.remove('active');
    }

    // Fungsi ketika tombol Terima / Tolak ditekan
    function handleAction(status) {
      alert('Anda memilih untuk ' + status + ' bimbingan ID: ' + activeBookingId);
      // Di sini nantinya Anda bisa memicu subjek form post request atau AJAX / Axios untuk mengubah kolom status bimbingan di database
      closePreviewModal();
    }

    // === 1. BAR CHART CONFIGURATION ===
    const ctxBar = document.getElementById('satisfactionBarChart').getContext('2d');
    new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: ['Nyaman', 'Dampak', 'Aman', 'Akses', 'Relasi'],
        datasets: [{
          data: [4.8, 4.5, 4.9, 4.2, 4.6],
          backgroundColor: '#4b2e2b',
          hoverBackgroundColor: '#7a4a35',
          borderRadius: 4,
          barPercentage: 0.45
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { min: 1, max: 5, ticks: { stepSize: 1 } },
          x: { ticks: { color: '#4b2e2b' }, grid: { display: false } }
        }
      }
    });

    // === 2. PIE CHART CONFIGURATION ===
    const ctxPie = document.getElementById('pieCategoryChart').getContext('2d');
    new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['Akademik (37.5%)', 'Pribadi (25%)', 'Keluarga (25%)', 'Karir (12.5%)'],
        datasets: [{
          data: [3, 2, 2, 1],
          backgroundColor: ['#4b2e2b', '#7a4a35', '#cfa381', '#e4d2be'],
          borderWidth: 2,
          borderColor: '#ffffff'
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });
    function handleAction(status) {
      if (!activeBookingId) return;

      if (status === 'terima') {
        if (confirm('Apakah Anda yakin ingin menerima permintaan sesi bimbingan ini?')) {
          const acceptForm = document.getElementById('accept-booking-form');
          // Set action URL secara dinamis menuju rute accept
          acceptForm.action = `/booking/${activeBookingId}/accept`;
          acceptForm.submit();
        }
      } else if (status === 'tolak') {
        if (confirm('Apakah Anda yakin ingin menolak dan menghapus permintaan bimbingan ini?')) {
          const rejectForm = document.getElementById('reject-booking-form');
          // Set action URL secara dinamis menuju rute reject
          rejectForm.action = `/booking/${activeBookingId}/reject`;
          rejectForm.submit();
        }
      }
      
      closePreviewModal();
    }
  </script>
@endsection