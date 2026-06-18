<aside class="dash-sidebar">
    <div class="sidebar-top">
        <a href="{{ route('landing') }}" class="dash-logo">Kebaya</a>
        <p class="sidebar-tagline">Mental Health Sanctuary</p>
    </div>

    <nav class="dash-nav">
        <span class="nav-section-label">Menu Utama</span>
        
        {{-- Menu Dashboard (Muncul untuk Semua Role) --}}
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-item-icon material-symbols-rounded">dashboard</span>
            <span class="nav-item-text">Dashboard</span>
        </a>

        {{-- ================= MENU KHUSUS MAHASISWA ================= --}}
        @if(Auth::user()->role === 'user')
            {{-- Menu Konsultasi --}}
            <a href="{{ route('dashboard.konsultasi') }}" class="nav-item {{ request()->routeIs('dashboard.konsultasi') ? 'active' : '' }}">
                <span class="nav-item-icon material-symbols-rounded">forum</span>
                <span class="nav-item-text">Konsultasi</span>
            </a>

            {{-- Menu Jurnal Saya --}}
            <a href="{{ route('dashboard.jurnal') }}" class="nav-item {{ request()->routeIs('dashboard.jurnal') ? 'active' : '' }}">
                <span class="nav-item-icon material-symbols-rounded">book</span>
                <span class="nav-item-text">Jurnal Saya</span>
            </a>
        @endif

        {{-- ================= MENU KHUSUS KONSELOR ================= --}}
        @if(Auth::user()->role === 'counselor')
            {{-- Anda bisa menambahkan menu khusus konselor di sini nanti jika diperlukan --}}
            {{-- Contoh: Menu Daftar Mahasiswa Bimbingan / Klien --}}
            {{-- 
            <a href="#" class="nav-item">
                <span class="nav-item-icon material-symbols-rounded">group</span>
                <span class="nav-item-text">Daftar Mahasiswa</span>
            </a> 
            --}}
        @endif

        {{-- Menu Riwayat Sesi (Muncul untuk Semua Role) --}}
        <a href="{{ route('dashboard.riwayat') }}" class="nav-item {{ request()->routeIs('dashboard.riwayat') ? 'active' : '' }}">
            <span class="nav-item-icon material-symbols-rounded">history</span>
            <span class="nav-item-text">Riwayat Sesi</span>
        </a>

        <span class="nav-section-label" style="margin-top:1rem;">Akun</span>
        
        {{-- Menu Pengaturan --}}
        <a href="{{ route('dashboard.pengaturan') }}" class="nav-item {{ request()->routeIs('dashboard.pengaturan') ? 'active' : '' }}">
            <span class="nav-item-icon material-symbols-rounded">settings</span>
            <span class="nav-item-text">Pengaturan</span>
        </a>
    </nav>

    {{-- KOTAK PROFIL BAWAH (DINAMIS) --}}
    <div class="sidebar-profile">
        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
        <div class="profile-info">
            <span class="profile-name">{{ Auth::user()->name }}</span>
            
            {{-- MENAMPILKAN ROLE SECARA DINAMIS --}}
            <span class="profile-role">
                {{ Auth::user()->role === 'counselor' ? 'Peer Counselor' : 'Mahasiswa' }}
            </span>
        </div>
        
        {{-- Tombol Keluar / Logout --}}
        <a href="#" class="btn-logout" title="Keluar" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="material-symbols-rounded">logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>