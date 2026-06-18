@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa — Kebaya')

@section('content')

    <header class="dash-header">
      <div class="welcome-text">
        <h1>Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
        <p>Bagaimana kondisi pikiran dan perasaanmu hari ini?</p>
      </div>
      <div class="dash-date">
        <span class="material-symbols-rounded">calendar_month</span>
        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
      </div>
    </header>

    <div class="dash-grid">

      {{-- ===== MOOD TRACKER CARD ===== --}}
      <div class="dash-card mood-card">
        <h3>Pelacak Suasana Hati</h3>
        <p class="card-subtitle">Pilih emosi yang paling menggambarkan dirimu saat ini:</p>
        <div class="mood-selector">
          <button class="mood-btn">😊 <span>Tenang</span></button>
          <button class="mood-btn">😓 <span>Cemas</span></button>
          <button class="mood-btn">🥱 <span>Lelah</span></button>
          <button class="mood-btn">😢 <span>Sedih</span></button>
          <button class="mood-btn">😡 <span>Stres</span></button>
        </div>
      </div>

      {{-- ===== SESI TERDEKAT CARD ===== --}}
      <div class="dash-card session-card">
        <div class="card-header-flex">
          <h3>Sesi Terdekat</h3>
          <span class="badge badge-active">Mendatang</span>
        </div>
        @if(isset($nextSession))
          <div class="session-box">
            <div class="session-counselor">
              <div class="counselor-img-placeholder">🎯</div>
              <div>
                <h4>{{ $nextSession->counselor->name ?? 'Kak Salsa' }}</h4>
                <p>Konselor Sebaya • Psikologi</p>
              </div>
            </div>
            <div class="session-time">
              <span class="material-symbols-rounded">schedule</span>
              <p>{{ \Carbon\Carbon::parse($nextSession->scheduled_at)->translatedFormat('l, d F Y') }}, {{ \Carbon\Carbon::parse($nextSession->scheduled_at)->format('H:i') }} WIB (Online via Live Chat)</p>
            </div>
            <button class="btn-dash-primary">Masuk Ruang Obrolan</button>
          </div>
        @else
          <div class="session-box">
            <div class="session-counselor">
              <div class="counselor-img-placeholder">🎯</div>
              <div>
                <h4>Kak Salsa</h4>
                <p>Konselor Sebaya • Psikologi</p>
              </div>
            </div>
            <div class="session-time">
              <span class="material-symbols-rounded">schedule</span>
              <p>Hari ini, 16:00 WIB (Online via Live Chat)</p>
            </div>
            <button class="btn-dash-primary">Masuk Ruang Obrolan</button>
          </div>
        @endif
      </div>

      {{-- ===== JURNAL PRIBADI CARD ===== --}}
      <div class="dash-card journal-card">
        <h3>Catatan Jurnal Pribadi</h3>
        <p class="card-subtitle">Tuliskan apa saja yang mengganjal atau ingin kamu refleksikan hari ini secara rahasia.</p>
        <textarea placeholder="Ceritakan sesuatu... (Hanya kamu yang dapat membaca jurnal ini)"></textarea>
        <button class="btn-dash-secondary">Simpan Jurnal</button>
      </div>

      {{-- ===== FEEDBACK / KUESIONER TRIGGER CARD ===== --}}
      <div class="dash-card feedback-trigger-card" style="display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; padding:2rem;">
        <h4>Bantu Kami Berkembang</h4>
        <p class="card-subtitle" style="margin-bottom:1rem;">Punya waktu 1 menit? Bagikan pengalaman Anda menggunakan Kebaya.</p>
        <button id="open-ux-modal-btn" class="btn-dash-primary" style="width:auto; padding:0.6rem 1.5rem;">Isi Kuesioner</button>
      </div>

      {{-- ===== REKOMENDASI RELAKSASI CARD ===== --}}
      <div class="dash-card resources-card">
        <h3>Rekomendasi Relaksasi</h3>
        <div class="resource-item">
          <span class="material-symbols-rounded">ldl</span>
          <div>
            <h5>Latihan Pernapasan 4-7-8</h5>
            <p>Audio panduan durasi 3 menit untuk meredakan kepanikan akademik.</p>
          </div>
        </div>
        <div class="resource-item">
          <span class="material-symbols-rounded">article</span>
          <div>
            <h5>Mengatasi Burnout Tugas Akhir</h5>
            <p>Tips praktis menyeimbangkan produktivitas dan kesehatan mental.</p>
          </div>
        </div>
      </div>

    </div>{{-- end .dash-grid --}}

    {{-- ===== MODAL KUESIONER / FEEDBACK ===== --}}
    <div id="questionnaire-modal" class="modal-overlay" style="display:none;">
      <div class="auth-card-floating modal-form-card animate-fade-in">

        <div class="auth-card-header" style="position:relative;">
          <h2 class="split-title" style="font-size:1.8rem;">Evaluasi Kebaya</h2>
          <p class="split-subtitle">Suara Anda membantu kami membangun tempat bersandar digital yang lebih nyaman.</p>
          <button id="close-modal-btn" style="position:absolute; top:0; right:0; background:none; border:none; font-size:1.5rem; cursor:pointer; color:var(--muted);">&times;</button>
        </div>

        <div class="modal-card-body">
          <form id="modal-uiux-form" class="auth-form-modern">

            {{-- Parameter 1: Kemudahan Penggunaan --}}
            <div class="split-form-group" style="margin-bottom:1.25rem;">
              <label style="font-weight:500; color:var(--brown);">1. Kemudahan Penggunaan</label>
              <p class="card-subtitle" style="margin:0.2rem 0 0.5rem; font-size:0.8rem;">Seberapa mudah Anda mengoperasikan menu dan fitur di dashboard ini?</p>
              <div class="time-pills-wrapper" style="grid-template-columns:repeat(5,1fr);">
                <label class="time-pill-option"><input type="radio" name="kemudahan_1" value="1" required><span class="time-text">1</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_1" value="2"><span class="time-text">2</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_1" value="3"><span class="time-text">3</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_1" value="4"><span class="time-text">4</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_1" value="5"><span class="time-text">5</span></label>
              </div>
            </div>

            {{-- Parameter 2: Kejelasan Informasi --}}
            <div class="split-form-group" style="margin-bottom:1.25rem;">
              <label style="font-weight:500; color:var(--brown);">2. Kejelasan Informasi</label>
              <p class="card-subtitle" style="margin:0.2rem 0 0.5rem; font-size:0.8rem;">Apakah teks, panduan relaksasi, dan menu tertulis dengan jelas?</p>
              <div class="time-pills-wrapper" style="grid-template-columns:repeat(5,1fr);">
                <label class="time-pill-option"><input type="radio" name="kejelasan" value="1" required><span class="time-text">1</span></label>
                <label class="time-pill-option"><input type="radio" name="kejelasan" value="2"><span class="time-text">2</span></label>
                <label class="time-pill-option"><input type="radio" name="kejelasan" value="3"><span class="time-text">3</span></label>
                <label class="time-pill-option"><input type="radio" name="kejelasan" value="4"><span class="time-text">4</span></label>
                <label class="time-pill-option"><input type="radio" name="kejelasan" value="5"><span class="time-text">5</span></label>
              </div>
            </div>

            {{-- Parameter 3: Kemudahan Navigasi --}}
            <div class="split-form-group" style="margin-bottom:1.25rem;">
              <label style="font-weight:500; color:var(--brown);">3. Kemudahan Akses / Navigasi</label>
              <p class="card-subtitle" style="margin:0.2rem 0 0.5rem; font-size:0.8rem;">Seberapa cepat dan ringkas Anda dapat berpindah antar halaman?</p>
              <div class="time-pills-wrapper" style="grid-template-columns:repeat(5,1fr);">
                <label class="time-pill-option"><input type="radio" name="kemudahan_2" value="1" required><span class="time-text">1</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_2" value="2"><span class="time-text">2</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_2" value="3"><span class="time-text">3</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_2" value="4"><span class="time-text">4</span></label>
                <label class="time-pill-option"><input type="radio" name="kemudahan_2" value="5"><span class="time-text">5</span></label>
              </div>
            </div>

            {{-- Parameter 4: Kecepatan Website --}}
            <div class="split-form-group" style="margin-bottom:1.25rem;">
              <label style="font-weight:500; color:var(--brown);">4. Kecepatan Website</label>
              <p class="card-subtitle" style="margin:0.2rem 0 0.5rem; font-size:0.8rem;">Bagaimana penilaian Anda terhadap kecepatan muat (loading) halaman?</p>
              <div class="time-pills-wrapper" style="grid-template-columns:repeat(5,1fr);">
                <label class="time-pill-option"><input type="radio" name="kecepatan" value="1" required><span class="time-text">1</span></label>
                <label class="time-pill-option"><input type="radio" name="kecepatan" value="2"><span class="time-text">2</span></label>
                <label class="time-pill-option"><input type="radio" name="kecepatan" value="3"><span class="time-text">3</span></label>
                <label class="time-pill-option"><input type="radio" name="kecepatan" value="4"><span class="time-text">4</span></label>
                <label class="time-pill-option"><input type="radio" name="kecepatan" value="5"><span class="time-text">5</span></label>
              </div>
            </div>

            {{-- Parameter 5: Kebergunaan Fitur --}}
            <div class="split-form-group" style="margin-bottom:1.5rem;">
              <label style="font-weight:500; color:var(--brown);">5. Kebergunaan Fitur</label>
              <p class="card-subtitle" style="margin:0.2rem 0 0.5rem; font-size:0.8rem;">Apakah fitur Pelacak Suasana Hati & Jurnal bermanfaat bagi kondisi Anda?</p>
              <div class="time-pills-wrapper" style="grid-template-columns:repeat(5,1fr);">
                <label class="time-pill-option"><input type="radio" name="kebergunaan" value="1" required><span class="time-text">1</span></label>
                <label class="time-pill-option"><input type="radio" name="kebergunaan" value="2"><span class="time-text">2</span></label>
                <label class="time-pill-option"><input type="radio" name="kebergunaan" value="3"><span class="time-text">3</span></label>
                <label class="time-pill-option"><input type="radio" name="kebergunaan" value="4"><span class="time-text">4</span></label>
                <label class="time-pill-option"><input type="radio" name="kebergunaan" value="5"><span class="time-text">5</span></label>
              </div>
            </div>

            {{-- Saran Tambahan --}}
            <div class="split-form-group" style="margin-top:1rem;">
              <label>6. Saran tambahan untuk perbaikan kenyamanan website:</label>
              <textarea name="ux_feedback" class="booking-textarea" placeholder="Tuliskan saran Anda..." style="height:80px; min-height:80px; width:100%; box-sizing:border-box;"></textarea>
            </div>

            <button type="submit" class="btn-dash-primary" style="margin-top:1.5rem; width:100%;">Kirim Feedback</button>

          </form>
        </div>

      </div>
    </div>{{-- end #questionnaire-modal --}}

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {

    // ===== MOOD TRACKER =====
    document.querySelectorAll('.mood-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.mood-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // ===== MODAL KUESIONER =====
    const openModalBtn  = document.getElementById('open-ux-modal-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const modalArea     = document.getElementById('questionnaire-modal');
    const modalForm     = document.getElementById('modal-uiux-form');

    if (openModalBtn && modalArea) {
      openModalBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modalArea.style.display = 'flex';
      });
    }

    if (closeModalBtn && modalArea) {
      closeModalBtn.addEventListener('click', () => {
        modalArea.style.display = 'none';
      });
    }

    if (modalArea) {
      modalArea.addEventListener('click', (e) => {
        if (e.target === modalArea) modalArea.style.display = 'none';
      });
    }

    if (modalForm) {
      modalForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Kirim data ke route Laravel
        fetch("{{ route('ux.feedback.store') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            kemudahan_1: formData.get('kemudahan_1'),
            kejelasan:   formData.get('kejelasan'),
            kemudahan_2: formData.get('kemudahan_2'),
            kecepatan:   formData.get('kecepatan'),
            kebergunaan: formData.get('kebergunaan'),
            ux_feedback: formData.get('ux_feedback')
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Tampilkan pesan sukses UI
            this.innerHTML = `
              <div style="text-align:center; padding:2.5rem 1rem;">
                <span class="material-symbols-rounded" style="font-size:3.5rem; color:var(--green);">verified</span>
                <h4>Terima Kasih!</h4>
                <p>Data telah kami rekam.</p>
              </div>
            `;
            setTimeout(() => { modalArea.style.display = 'none'; }, 2000);
          }
        })
        .catch(error => console.error('Error:', error));
      });
    }
  });
</script>
@endsection