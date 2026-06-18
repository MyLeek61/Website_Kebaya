@extends('layouts.app')

@section('title', 'Permintaan Sesi Dikirim — Kebaya')

@section('content')
  <!-- Variabel Gaya Tambahan Khusus Halaman Status -->
  <style>
    :root {
      --orange-warn: #b57c1e;
      --orange-bg:   #fdf5e6;
    }

    /* Top Banner Status: Menunggu Pengesahan */
    .pending-status-banner {
      background-color: var(--orange-bg);
      border: 1px solid rgba(181, 124, 30, 0.15);
      border-radius: 16px;
      padding: 1.25rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 2.5rem;
    }
    .status-left { display: flex; align-items: center; gap: 1rem; }
    .status-title { font-weight: 600; color: var(--orange-warn); font-size: 1.05rem; }
    .status-sub { font-size: 0.85rem; color: var(--muted); }

    /* Layout Utama Berdampingan */
    .pending-main-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 2.5rem;
      align-items: start;
    }

    .pending-card {
      background-color: white;
      border-radius: 20px;
      padding: 2.5rem;
      border: 1px solid var(--warm);
      box-shadow: 0 4px 15px rgba(75, 46, 43, 0.01);
    }

    .pending-card h2 { font-family: 'DM Serif Display', serif; font-size: 2rem; color: var(--brown); margin-bottom: 0.5rem; }
    .lead-text { color: var(--muted); margin-bottom: 2rem; font-size: 0.95rem; }

    /* Ringkasan Pengajuan Pengguna */
    .summary-ticket-box {
      background-color: var(--cream);
      border-radius: 14px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      border-left: 4px solid var(--sand);
    }
    .ticket-row {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      font-size: 0.9rem;
      border-bottom: 1px dashed rgba(75, 46, 43, 0.1);
    }
    .ticket-row:last-child { border-bottom: none; }
    .ticket-label { color: var(--muted); }
    .ticket-value { font-weight: 600; color: var(--brown); }

    /* Garis Waktu Keputusan / Alur Evaluasi */
    .timeline-container { display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 1rem; }
    .timeline-node { display: flex; gap: 1rem; align-items: start; position: relative; }
    .node-icon-wrapper {
      width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0;
    }
    .node-success { background-color: var(--green-bg); color: var(--green); }
    .node-process { background-color: var(--orange-bg); color: var(--orange-warn); animation: pulseSoft 2s infinite; }
    .node-details h4 { font-size: 0.95rem; color: var(--brown); margin-bottom: 0.15rem; }
    .node-details p { font-size: 0.85rem; color: var(--muted); line-height: 1.5; }

    @keyframes pulseSoft {
      0% { opacity: 0.7; }
      50% { opacity: 1; }
      100% { opacity: 0.7; }
    }

    /* Catatan Disclaimer Kebijakan Kampus */
    .policy-disclaimer-box {
      background-color: #fafafa;
      border-radius: 12px;
      padding: 1.25rem;
      border: 1px solid #eee;
      margin-top: 2rem;
    }
    .policy-disclaimer-box p {
      font-size: 0.82rem;
      color: var(--muted);
      line-height: 1.6;
    }

    /* Tombol Batal / Dashboard */
    .action-group-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
      border-top: 1px solid var(--cream);
      padding-top: 1.5rem;
    }
    .btn-secondary-outline {
      flex: 1; text-align: center; text-decoration: none; border: 1px solid var(--warm);
      color: var(--muted); padding: 0.85rem; border-radius: 30px; font-weight: 500; font-size: 0.9rem;
      transition: all 0.2s;
    }
    .btn-secondary-outline:hover { background-color: var(--cream); color: var(--brown); }

    /* Sisi Kanan: Kartu Profil Konselor yang Diajukan */
    .target-counselor-card { text-align: center; display: flex; flex-direction: column; align-items: center; }
    .avatar-placeholder {
      width: 80px; height: 80px; background-color: var(--sand); color: var(--brown);
      font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 600;
      border-radius: 50%; display: flex; align-items: center; justify-content: center;
      margin-bottom: 1rem;
    }
    .target-counselor-card h3 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: var(--brown); margin-bottom: 0.2rem; }
    .counselor-dept { font-size: 0.8rem; color: var(--muted); margin-bottom: 1.5rem; }
    
    .notice-box-right {
      background-color: var(--cream);
      padding: 1.25rem;
      border-radius: 12px;
      font-size: 0.85rem;
      text-align: left;
      border: 1px solid var(--warm);
      color: var(--text);
    }
    .notice-box-right h5 { font-weight: 600; margin-bottom: 0.5rem; color: var(--brown); display: flex; align-items: center; gap: 4px; }

    @media (max-width: 992px) {
      .pending-main-grid { grid-template-columns: 1fr; gap: 2rem; }
    }
  </style>

  <!-- BANNER NOTIFIKASI UTAMA -->
  <div class="pending-status-banner">
    <div class="status-left">
      <span class="material-symbols-rounded" style="color: var(--orange-warn)">pending_actions</span>
      <div class="status-details">
        <p class="status-title">Permintaan Sesi Sedang Ditinjau</p>
        <p class="status-sub">Konselor sedang memvalidasi kesesuaian jadwal & urgensi keluhan.</p>
      </div>
    </div>
    <span class="material-symbols-rounded" style="color: var(--orange-warn); font-size: 1.2rem;">hourglass_empty</span>
  </div>

  <!-- GRID KONTEN -->
  <div class="pending-main-grid">
    
    <!-- KARTU UTAMA KIRI -->
    <div class="pending-card">
      <h2>Menunggu Penerimaan Sesi</h2>
      <p class="lead-text">Permintaan Anda sudah masuk ke sistem pendampingan psikologis kampus. Silakan pantau berkala status penerimaan di bawah ini.</p>
      
      <!-- TIKET RINGKASAN DATA REAL DARI DATABASE -->
      <div class="summary-ticket-box">
        <div class="ticket-row">
          <span class="ticket-label">ID Permintaan</span>
          <span class="ticket-value">#KBY-{{ $booking->id ?? '88321' }}</span>
        </div>
        <div class="ticket-row">
          <span class="ticket-label">Metode Konseling</span>
          <span class="ticket-value">
            {{ $booking->booking_method == 'chat' ? 'Live Chat (Teks)' : 'Online (Video Call)' }}
          </span>
        </div>
        <div class="ticket-row">
          <span class="ticket-label">Rencana Jadwal</span>
          <span class="ticket-value">
            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }} ({{ $booking->booking_time }} WIB)
          </span>
        </div>
        <div class="ticket-row">
          <span class="ticket-label">Penerimaan</span>
          <span class="ticket-value" style="color: var(--orange-warn); text-transform: capitalize;">
            {{ $booking->penerimaan ?? 'Belum' }} Disetujui
          </span>
        </div>
        <div class="ticket-row">
          <span class="ticket-label">Status Alur</span>
          <span class="ticket-value" style="color: var(--orange-warn); text-transform: capitalize;">
            {{ $booking->status ?? 'Belum Diterima' }}
          </span>
        </div>
      </div>

      <!-- TIMELINE PRESENTASI DATA -->
      <div class="timeline-container">
        <div class="timeline-node">
          <div class="node-icon-wrapper node-success">
            <span class="material-symbols-rounded" style="font-size: 1rem;">check</span>
          </div>
          <div class="node-details">
            <h4>Permintaan Berhasil Dikirim</h4>
            <p>Formulir keluhan awal Anda telah disimpan dan dienkripsi dengan aman agar privasi tetap terjaga.</p>
          </div>
        </div>

        <div class="timeline-node">
          <div class="node-icon-wrapper node-process">
            <span class="material-symbols-rounded" style="font-size: 1rem;">sync</span>
          </div>
          <div class="node-details">
            <h4>Pengecekan Ketersediaan oleh {{ $booking->counselor->name ?? 'Konselor' }}</h4>
            <p>Konselor meninjau apakah slot waktu atau topik keluhan sesuai dengan kapasitas keahlian pendampingan mereka.</p>
          </div>
        </div>
      </div>

      <div class="policy-disclaimer-box">
        <p><strong>💡 Mengapa permintaan bisa tidak diterima?</strong><br>
        Demi menjaga kualitas bimbingan, konselor berhak mengalihkan atau menolak permintaan jika jadwal mendadak bertabrakan dengan agenda akademik utama, atau jika kondisi keluhan memerlukan penanganan tingkat lanjut dari psikolog klinis profesional.</p>
      </div>

      <!-- AKSI TOMBOL -->
      <div class="action-group-buttons">
        <a href="{{ route('dashboard') }}" class="btn-secondary-outline" style="border-color: var(--brown); color: var(--brown); font-weight: 600; text-decoration: none; text-align: center;">
          Kembali ke Dashboard
        </a>
        
        <form action="{{ route('dashboard.booking.cancel', ['id' => $booking->id]) }}" method="POST" style="flex: 1; display: inline-block;" onsubmit=\"return confirm('Apakah Anda yakin ingin membatalkan pengajuan konsultasi ini?')\">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-secondary-outline" style="width: 100%; background: none; cursor: pointer; border: 1px solid var(--warm); color: var(--muted); padding: 0.85rem; border-radius: 30px; font-weight: 500; font-size: 0.9rem;">
            Batalkan Permintaan
          </button>
        </form>
      </div>
    </div>

    <!-- KARTU INFORMASI KONSELOR KANAN -->
    <div class="pending-card target-counselor-card">
      <div class="avatar-placeholder">
        {{ $booking->counselor->initials ?? 'CS' }}
      </div>
      <h3>{{ $booking->counselor->name ?? 'Nama Konselor' }}</h3>
      <p class="counselor-dept">{{ $booking->counselor->specialization ?? 'Peer Counselor Pilihan Anda' }}</p>
      
      <div class="notice-box-right">
        <h5>
          <span class="material-symbols-rounded" style="font-size: 1.1rem; color: var(--mid)">info</span>
          Perkiraan Waktu Respons
        </h5>
        <p style="line-height: 1.5; color: var(--muted);">Konselor kampus biasanya memberikan kepastian penerimaan/penolakan jadwal dalam waktu <strong>1x24 jam</strong> hari kerja. Anda juga akan menerima notifikasi otomatis jika status berubah.</p>
      </div>
    </div>

  </div>
@endsection