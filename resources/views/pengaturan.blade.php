@extends('layouts.app')

@section('title', 'Pengaturan Akun — Kebaya')

@section('content')
    <header class="dash-header">
      <div class="welcome-text">
        <h1>Pengaturan Akun ⚙️</h1>
        <p>Kelola informasi profil, preferensi notifikasi, dan ubah kata sandi akun keamananmu.</p>
      </div>
    </header>

    <div class="settings-main-wrapper" style="display: flex; gap: 2rem; margin-top: 2rem; align-items: flex-start;">
      
      <aside class="settings-tabs-aside" style="flex: 0.8; background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 0.5rem;">
        <button class="settings-tab-btn active" onclick="switchSettingsTab(event, 'profile-section')">
          <span class="material-symbols-rounded">person</span> Profil Pribadi
        </button>
        <button class="settings-tab-btn" onclick="switchSettingsTab(event, 'security-section')">
          <span class="material-symbols-rounded">shield</span> Keamanan & Sandi
        </button>
        <button class="settings-tab-btn" onclick="switchSettingsTab(event, 'notifications-section')">
          <span class="material-symbols-rounded">notifications</span> Preferensi Notifikasi
        </button>
      </aside>

      <div class="settings-content-panels" style="flex: 2.2; background: #fff; padding: 2rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05);">
        
        {{-- PANEL 1: PROFIL PRIBADI --}}
        <section id="profile-section" class="settings-section active">
          <form onsubmit="saveSettings(event)">
            @csrf
            <div class="settings-panel-header" style="margin-bottom: 2rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 1rem;">
              <h3 style="color: var(--brown); margin: 0;">Informasi Profil</h3>
              <p style="color: var(--muted); font-size: 0.85rem; margin-top: 0.25rem;">Perbarui data identitas diri dan foto profil ruang amanmu.</p>
            </div>

            <div class="avatar-upload-row" style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
              <div class="avatar-preview-box" style="position: relative; width: 84px; height: 84px; border-radius: 50%; overflow: hidden; background: var(--sand); display: flex; align-items: center; justify-content: center; border: 2px solid var(--warm);">
                <img id="avatarImage" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                <span id="avatarInitials" style="font-weight: 600; font-size: 1.8rem; color: var(--brown);">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
              </div>
              <div>
                <label for="avatarFileInput" class="btn-dash-primary" style="display: inline-block; width: auto; padding: 0.5rem 1.25rem; font-size: 0.85rem; cursor: pointer;">
                  Pilih Foto Baru
                </label>
                <input type="file" id="avatarFileInput" accept="image/*" onchange="previewAvatar(event)" style="display: none;">
                <p style="color: var(--muted); font-size: 0.75rem; margin-top: 0.5rem;">Maksimal ukuran file 2MB (Format: JPG, PNG).</p>
              </div>
            </div>

            <div class="settings-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
              <div class="form-group">
                <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Nama Lengkap</label>
                <input type="text" value="{{ Auth::user()->name }}" class="journal-input-text" required>
              </div>
              <div class="form-group">
                <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Alamat Email</label>
                <input type="email" value="{{ Auth::user()->email }}" class="journal-input-text" readonly style="background: var(--cream); cursor: not-allowed;">
              </div>
              <div class="form-group">
                <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Nomor Telepon / WA</label>
                <input type="text" value="{{ Auth::user()->phone ?? '' }}" placeholder="Contoh: 08123456789" class="journal-input-text">
              </div>
              <div class="form-group">
                <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Fakultas / Program Studi</label>
                <input type="text" placeholder="Masukkan Fakultas Anda" class="journal-input-text">
              </div>
            </div>

            <div class="settings-form-footer" style="border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1.5rem; text-align: right;">
              <button type="submit" class="btn-dash-primary" style="width: auto; padding: 0.75rem 2rem;">Simpan Perubahan Profil</button>
            </div>
          </form>
        </section>

        {{-- PANEL 2: KEAMANAN & SANDI --}}
        <section id="security-section" class="settings-section" style="display: none;">
          <form onsubmit="saveSettings(event)">
            @csrf
            <div class="settings-panel-header" style="margin-bottom: 2rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 1rem;">
              <h3 style="color: var(--brown); margin: 0;">Keamanan Akun</h3>
              <p style="color: var(--muted); font-size: 0.85rem; margin-top: 0.25rem;">Ganti kata sandi secara berkala untuk menjaga kerahasiaan lembar jurnal Anda.</p>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Kata Sandi Saat Ini</label>
              <input type="password" placeholder="••••••••" class="journal-input-text" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Kata Sandi Baru</label>
              <input type="password" placeholder="••••••••" class="journal-input-text" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Konfirmasi Kata Sandi Baru</label>
              <input type="password" placeholder="••••••••" class="journal-input-text" required>
            </div>

            <div class="settings-form-footer" style="border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1.5rem; text-align: right;">
              <button type="submit" class="btn-dash-primary" style="width: auto; padding: 0.75rem 2rem;">Perbarui Kata Sandi</button>
            </div>
          </form>
        </section>

        {{-- PANEL 3: PREFERENSI NOTIFIKASI --}}
        <section id="notifications-section" class="settings-section" style="display: none;">
          <div class="settings-panel-header" style="margin-bottom: 2rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 1rem;">
            <h3 style="color: var(--brown); margin: 0;">Preferensi Notifikasi</h3>
            <p style="color: var(--muted); font-size: 0.85rem; margin-top: 0.25rem;">Atur bagaimana cara Kebaya berinteraksi dan mengirim pengingat kepadamu.</p>
          </div>

          <div class="notification-options-stack" style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2rem;">
            <div class="notif-toggle-item" style="display: flex; justify-content: space-between; align-items: center;">
              <div>
                <h5 style="margin: 0; color: var(--brown); font-size: 0.95rem;">Pengingat Menulis Jurnal</h5>
                <p style="margin: 0.25rem 0 0 0; font-size: 0.8rem; color: var(--muted);">Dapatkan pengingat harian ramah di malam hari untuk merilis emosi.</p>
              </div>
              <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
              </label>
            </div>

            <div class="notif-toggle-item" style="display: flex; justify-content: space-between; align-items: center;">
              <div>
                <h5 style="margin: 0; color: var(--brown); font-size: 0.95rem;">Notifikasi Obrolan Konseling</h5>
                <p style="margin: 0.25rem 0 0 0; font-size: 0.8rem; color: var(--muted);">Beritahu saya melalui email jika konselor mengirim pesan baru.</p>
              </div>
              <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
              </label>
            </div>
          </div>

          <div class="settings-form-footer" style="border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1.5rem; text-align: right;">
            <button type="button" class="btn-dash-primary" style="width: auto; padding: 0.75rem 2rem;" onclick="alert('Preferensi notifikasi berhasil disimpan!')">
              Simpan Preferensi Notifikasi
            </button>
          </div>
        </section>

      </div>
    </div>
@endsection

@section('scripts')
  <script>
    // 1. Logika Perpindahan Tab Halaman Pengaturan
    function switchSettingsTab(event, sectionId) {
      document.querySelectorAll('.settings-tab-btn').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.settings-section').forEach(sec => sec.style.display = 'none');

      event.currentTarget.classList.add('active');
      document.getElementById(sectionId).style.display = 'block';
    }

    // 2. Logika Preview Foto Profil Saat Diunggah
    function previewAvatar(event) {
      const reader = new FileReader();
      const output = document.getElementById('avatarImage');
      const initials = document.getElementById('avatarInitials');
      
      reader.onload = function(){
        output.src = reader.result;
        output.style.display = 'block';
        if(initials) initials.style.display = 'none';
      };
      
      if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
      }
    }

    // 3. Logika Aksi Pengiriman Form Simpan Statis
    function saveSettings(event) {
      event.preventDefault();
      alert('Perubahan pengaturan Anda berhasil disimpan!');
    }
  </script>
@endsection