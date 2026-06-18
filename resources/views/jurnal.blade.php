@extends('layouts.app')

@section('title', 'Jurnal Saya — Kebaya')

@section('content')
    <main class="journal-main-layout" style="display: flex; gap: 2rem; align-items: flex-start;">
      
      {{-- KOLOM KIRI: FORMULIR INPUT JURNAL --}}
      <section class="journal-write-column" style="flex: 1.5;">
        <div class="journal-header" style="margin-bottom: 2rem;">
          <h1 style="color: var(--brown); font-family: 'DM Serif Display', serif; font-size: 2.2rem; margin-bottom: 0.5rem;">Jurnal Refleksi Pribadi ✍️</h1> {{-- --}}
          <p style="color: var(--muted); font-size: 0.95rem;">Luapkan segala emosi, kekhawatiran, atau cerita bahagiamu hari ini tanpa takut dihakimi.</p> {{--[cite: 15] --}}
        </div>

        <form action="#" method="POST" class="journal-form">
          @csrf {{-- Proteksi Token Keamanan Laravel --}}
          <div class="journal-card" style="margin-top: 0; background: #width: 100%;">
            
            {{-- Input Judul --}}
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label for="journal-title" style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Judul Catatan</label> {{--[cite: 15] --}}
              <input type="text" id="journal-title" name="title" class="journal-input-text" placeholder="Berikan judul emosi atau ceritamu hari ini..." required> {{--[cite: 15] --}}
            </div>

            {{-- Input Pemilihan Mood --}}
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Bagaimana energimu saat menulis?</label> {{--[cite: 15] --}}
              <div class="journal-mood-row" style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <label class="journal-mood-option">
                  <input type="radio" name="journal_mood" value="happy" checked> {{--[cite: 15] --}}
                  <span class="mood-emoji-pill">😊 Tenang</span> {{--[cite: 15] --}}
                </label>
                <label class="journal-mood-option">
                  <input type="radio" name="journal_mood" value="anxious"> {{--[cite: 15] --}}
                  <span class="mood-emoji-pill">😓 Cemas</span> {{--[cite: 15] --}}
                </label>
                <label class="journal-mood-option">
                  <input type="radio" name="journal_mood" value="tired"> {{--[cite: 15] --}}
                  <span class="mood-emoji-pill">🥱 Lelah</span> {{--[cite: 15] --}}
                </label>
                <label class="journal-mood-option">
                  <input type="radio" name="journal_mood" value="sad"> {{--[cite: 15] --}}
                  <span class="mood-emoji-pill">😢 Sedih</span> {{--[cite: 15] --}}
                </label>
              </div>
            </div>

            {{-- Input Isi Diari --}}
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label for="journal-content" style="font-weight: 600; color: var(--brown); margin-bottom: 0.5rem; display: block;">Isi Diari</label> {{--[cite: 15] --}}
              <textarea id="journal-content" name="content" class="journal-textarea-large" rows="12" placeholder="Ketikan apa pun di sini secara bebas... (Hanya kamu yang dapat membaca lembaran ini)" required></textarea> {{--[cite: 15] --}}
            </div>

            {{-- Tombol Aksi --}}
            <div class="journal-footer-actions" style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
              <div class="privacy-status" style="display: flex; align-items: center; gap: 6px; font-size: 0.85rem; color: var(--muted);">
                <span class="material-symbols-rounded" style="font-size: 1.1rem;">lock</span> Encrypted & Private {{--[cite: 15] --}}
              </div>
              <button type="submit" class="btn-dash-primary" style="width: auto; padding: 0.75rem 2rem;">Simpan Lembar Jurnal</button> {{--[cite: 15] --}}
            </div>
          </div>
        </form>
      </section>

      {{-- KOLOM KANAN: RIWAYAT TIMELINE SECARA STATIS (BISA DIDINAMISKAN NANTI) --}}
      <section class="journal-history-column" style="flex: 1; background: #fff; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05);">
        <div class="history-header" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <h3 style="margin: 0; color: var(--brown);">Lembaran Cerita Lalu</h3> {{--[cite: 15] --}}
            <p style="margin-top: 0.25rem; font-size: 0.85rem; color: var(--muted);">Melihat kembali proses bertumbuhmu.</p> {{--[cite: 15] --}}
          </div>
          <a href="#" class="see-all-journals" style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.8rem; font-weight: 600; color: var(--accent); text-decoration: none; transition: color 0.2s;">
            Lihat Semua
            <span class="material-symbols-rounded" style="font-size: 1rem;">arrow_forward</span> {{--[cite: 15] --}}
          </a>
        </div>

        <div class="history-timeline-list" style="display: flex; flex-direction: column; gap: 1.25rem;">
          
          <div class="history-journal-item" style="border-left: 3px solid #ffb703; padding-left: 1rem;">
            <div class="history-item-top" style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.5rem;">
              <span class="history-date" style="color: var(--muted);">Hari ini • 15 Jun</span> {{--[cite: 15] --}}
              <span class="history-mood-badge" style="color: #d62828;">😓 Cemas</span> {{--[cite: 15] --}}
            </div>
            <h4 style="margin: 0 0 0.25rem 0; color: var(--brown);">Overthinking Tugas Akhir & Presentasi</h4> {{--[cite: 15] --}}
            <p style="margin: 0; font-size: 0.85rem; color: var(--muted); line-height: 1.4;">Tadi siang rasanya deg-degan banget pas mau maju asistensi. Takut revisi total lagi kayak minggu lalu, tapi bersyukur jalannya lancar...</p> {{--[cite: 15] --}}
          </div>

          <div class="history-journal-item" style="border-left: 3px solid #2a9d8f; padding-left: 1rem;">
            <div class="history-item-top" style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.5rem;">
              <span class="history-date" style="color: var(--muted);">12 Juni 2026</span> {{--[cite: 15] --}}
              <span class="history-mood-badge-success" style="color: #2a9d8f;">😊 Tenang</span> {{--[cite: 15] --}}
            </div>
            <h4 style="margin: 0 0 0.25rem 0; color: var(--brown);">Sesi Konseling Pertama dengan Kak Salsa</h4> {{--[cite: 15] --}}
            <p style="margin: 0; font-size: 0.85rem; color: var(--muted); line-height: 1.4;">Akhirnya memberanikan diri buat pesan sesi obrolan lewat Kebaya. Ternyata beneran didengerin tanpa di-judge, ngerasa plong banget malam ini...</p> {{--[cite: 15] --}}
          </div>

          <div class="history-journal-item" style="border-left: 3px solid #6c757d; padding-left: 1rem;">
            <div class="history-item-top" style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.5rem;">
              <span class="history-date" style="color: var(--muted);">10 Juni 2026</span> {{--[cite: 15] --}}
              <span class="history-mood-badge-dark" style="color: #6c757d;">🥱 Lelah</span> {{--[cite: 15] --}}
            </div>
            <h4 style="margin: 0 0 0.25rem 0; color: var(--brown);">Energi Terkuras Habis Habisan</h4> {{--[cite: 15] --}}
            <p style="margin: 0; font-size: 0.85rem; color: var(--muted); line-height: 1.4;">Lagi ngerasa burnout parah gara-gara tugas kelompok numpuk barengan sama urusan organisasi kampus. Pengen istirahat seharian penuh besok...</p> {{--[cite: 15] --}}
          </div>

        </div>
      </section>

    </main>
@endsection