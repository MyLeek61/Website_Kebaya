<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckActiveSession;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Aplikasi Kebaya
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (Landing Page) - Terbuka untuk Umum
Route::get('/', function () {
    return view('index');
})->name('landing');


// 2. RUTE AUTENTIKASI (Hanya bisa diakses jika BELUM login / GUEST)
Route::middleware('guest')->group(function () {
    // Registrasi Akun
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
    
    // Login Akun
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});


// 3. RUTE KELUAR / LOGOUT (Hanya bisa diakses jika SUDAH login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('/dashboard/submit-ux-feedback', [DashboardController::class, 'storeUxFeedback'])
     ->name('ux.feedback.store')
     ->middleware('auth');

// 4. RUTE DASHBOARD TERPROTEKSI (Wajib Login / AUTH)
Route::middleware('auth')->group(function () {
    
    Route::controller(DashboardController::class)->group(function () {
        
        // Halaman Utama Dashboard
        Route::get('/dashboard', 'index')->name('dashboard');

        // 🔒 GRUP MIDDLEWARE KUSTOM: Menghalangi akses jika ada sesi aktif
        Route::middleware([CheckActiveSession::class])->group(function () {
            // Alur Fitur Pencarian Konselor Sebaya
            Route::get('/konsultasi', 'konsultasi')->name('dashboard.konsultasi');
            
            // Alur Fitur Reservasi / Pemesanan Jadwal (Booking)
            Route::get('/booking', 'booking')->name('dashboard.booking');
            Route::post('/booking', 'storeBooking')->name('dashboard.booking.store');
            Route::get('/booking/{id}/status', 'bookingStatus')->name('dashboard.booking.status');
        });

        // 🟢 HALAMAN SESI AKTIF (Hanya bisa dibuka jika diarahkan middleware / memiliki status 'sesi aktif')
        Route::get('/session-active/{id}', 'activeSession')->name('dashboard.booking.active');

        // Fitur Manajemen Booking Konselor (Terima, Selesai, Tolak)
        Route::post('/booking/{id}/accept', 'acceptBooking')->name('dashboard.booking.accept');
        Route::post('/booking/{id}/finish', 'finishBooking')->name('dashboard.booking.finish');
        Route::delete('/booking/{id}/reject', 'rejectBooking')->name('dashboard.booking.reject'); // Rute tolak konselor

        // Menu Utama Tambahan (General)
        Route::get('/jurnal', 'jurnal')->name('dashboard.jurnal');
        Route::get('/riwayat-sesi', 'riwayat')->name('dashboard.riwayat');
        Route::get('/pengaturan', 'pengaturan')->name('dashboard.pengaturan');
        
        // Pembatalan Booking dari sisi Mahasiswa
        Route::delete('/booking/{id}', 'cancelBooking')->name('dashboard.booking.cancel');
    });
});