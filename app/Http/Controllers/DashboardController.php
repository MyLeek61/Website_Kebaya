<?php

namespace App\Http\Controllers;


use App\Models\Counselor;
use App\Models\CounselorReview;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // 1. JIKA ROLE ADALAH ADMIN
    if ($user->role === 'admin') {
        $totalMahasiswa = \App\Models\User::where('role', 'user')->count();
        $totalKonselor = \App\Models\Counselor::count();
        $totalBooking = \App\Models\Booking::count();
        $sesiAktif = \App\Models\Booking::where('status', 'sesi aktif')->count();
        $uxData = \App\Models\UxOverview::all();

        // Fungsi helper untuk menghitung median
        $calculateMedian = function($collection, $column) {
            $values = $collection->pluck($column)->sort()->values();
            $count = $values->count();
            if ($count == 0) return 0;
            $middle = floor(($count - 1) / 2);
            if ($count % 2) return $values[$middle];
            return ($values[$middle] + $values[$middle + 1]) / 2;
        };

        $medianUx = [
            'kemudahan'   => $calculateMedian($uxData, 'kemudahan'),
            'kejelasan'   => $calculateMedian($uxData, 'kejelasan'),
            'dayatarik'   => $calculateMedian($uxData, 'dayatarik'),
            'kecepatan'   => $calculateMedian($uxData, 'kecepatan'),
            'kebergunaan' => $calculateMedian($uxData, 'kebergunaan'),
        ];

        // Query untuk statistik masalah agar tidak undefined
        // Pastikan kolom 'category' ada di tabel bookings (seperti yang kita bahas sebelumnya)
        $statistikMasalah = \App\Models\Booking::select('category', \DB::raw('count(*) as total'))
                            ->groupBy('category')
                            ->pluck('total', 'category');

        // Mengambil data UX Overview
        $avgUx = \App\Models\UxOverview::select(
            \DB::raw('avg(kemudahan) as avg_kemudahan'),
            \DB::raw('avg(kejelasan) as avg_kejelasan'),
            \DB::raw('avg(dayatarik) as avg_dayatarik'),
            \DB::raw('avg(kecepatan) as avg_kecepatan'),
            \DB::raw('avg(kebergunaan) as avg_kebergunaan')
        )->first();
        $calculateStdDev = function($collection, $column) {
            $values = $collection->pluck($column);
            $count = $values->count();
            if ($count == 0) return 0;
            
            $mean = $values->avg();
            $sumSquareDiff = $values->reduce(fn($carry, $item) => $carry + pow($item - $mean, 2), 0);
            return sqrt($sumSquareDiff / $count);
        };

        $stdDevUx = [
            'kemudahan'   => $calculateStdDev($uxData, 'kemudahan'),
            'kejelasan'   => $calculateStdDev($uxData, 'kejelasan'),
            'dayatarik'   => $calculateStdDev($uxData, 'dayatarik'),
            'kecepatan'   => $calculateStdDev($uxData, 'kecepatan'),
            'kebergunaan' => $calculateStdDev($uxData, 'kebergunaan'),
        ];

        return view('dashboard-admin', compact(
            'totalMahasiswa', 
            'totalKonselor', 
            'totalBooking', 
            'sesiAktif', 
            'statistikMasalah', 
            'avgUx',
            'medianUx',
            'stdDevUx'
        ));
    }

    // 2. JIKA ROLE ADALAH COUNSELOR
    if ($user->role === 'counselor') {
        $pendingBookings = \App\Models\Booking::where('penerimaan', 'belum')
                            ->with('user')
                            ->orderBy('booking_date', 'asc')
                            ->get();

        $upcomingSessions = \App\Models\Booking::where('penerimaan', 'sudah')
                            ->where('status', 'belum diterima')
                            ->with('user')
                            ->orderBy('booking_date', 'asc')
                            ->get();

        return view('dashboard-konselor', compact('pendingBookings', 'upcomingSessions'));

    }

    // 3. JIKA MAHASISWA / USER BIASA
    return view('dashboard-user');
}
    /**
     * Menampilkan Halaman Konsultasi dengan Data Konselor dari Database
     */

    /**
     * Fitur Tambahan: Halaman Jurnal Saya (Opsional/Placeholder)
     */
    public function jurnal()
    {
        return view('jurnal'); // Pastikan nanti Anda membuat file resources/views/jurnal.blade.php
    }

    /**
     * Fitur Tambahan: Halaman Riwayat Sesi (Opsional/Placeholder)
     */
    public function riwayat()
    {
        return view('riwayat-sesi'); // Pastikan nanti Anda membuat file resources/views/riwayat-sesi.blade.php
    }

    /**
     * Fitur Tambahan: Halaman Pengaturan (Opsional/Placeholder)
     */
    public function pengaturan()
    {
        return view('pengaturan'); // Pastikan nanti Anda membuat file resources/views/pengaturan.blade.php
    }

    /**
     * Menampilkan Halaman Form Booking dengan Data Review Asli dari Seeder
     */
    /**
     * Menampilkan Halaman Konsultasi dengan Data Konselor dari Database
     */
    public function konsultasi()
    {
        // PENGAMAN: Cek apakah user ini punya booking yang masih menggantung (belum diterima)
        $pendingBooking = \App\Models\Booking::where('user_id', Auth::id())
                                             ->where('penerimaan', 'belum')
                                             ->first();

        // Jika ada, langsung alihkan ke halaman status menunggu booking tersebut
        if ($pendingBooking) {
            return redirect()->route('dashboard.booking.status', ['id' => $pendingBooking->id])
                             ->with('info', 'Anda memiliki permintaan konseling yang sedang ditinjau.');
        }

        // Jika tidak ada booking menggantung, tampilkan halaman konsultasi seperti biasa
        $counselors = \App\Models\Counselor::limit(6)->get();
        return view('konsultasi', compact('counselors'));
    }

    /**
     * Menampilkan Halaman Form Booking dengan Data Review Asli dari Seeder
     */
    public function booking(Request $request)
    {
        // PENGAMAN: Cek apakah user ini punya booking yang masih menggantung (belum diterima)
        $pendingBooking = \App\Models\Booking::where('user_id', Auth::id())
                                             ->where('penerimaan', 'belum')
                                             ->first();

        // Jika ada, langsung alihkan juga dari halaman ini
        if ($pendingBooking) {
            return redirect()->route('dashboard.booking.status', ['id' => $pendingBooking->id])
                             ->with('info', 'Anda memiliki permintaan konseling yang sedang ditinjau.');
        }

        // Jika aman, jalankan kode pencarian konselor dan review seeder seperti biasa
        $counselorId = $request->query('counselor_id');
        $counselor = \App\Models\Counselor::find($counselorId) ?? \App\Models\Counselor::first();

        // Kueri DATA ASLI PIE CHART (Menggunakan kolom 'case_category' sesuai seeder)
        $akademikCount = \App\Models\CounselorReview::where('counselor_id', $counselor->id)->where('case_category', 'Akademik')->count();
        $pribadiCount  = \App\Models\CounselorReview::where('counselor_id', $counselor->id)->where('case_category', 'Pribadi')->count();
        $karirCount    = \App\Models\CounselorReview::where('counselor_id', $counselor->id)->where('case_category', 'Karir')->count();

        if ($akademikCount == 0 && $pribadiCount == 0 && $karirCount == 0) {
            $pieData = [33, 33, 34]; 
        } else {
            $pieData = [$akademikCount, $pribadiCount, $karirCount];
        }

        // Kueri DATA ASLI BAR CHART (Menggunakan kolom rating_... sesuai seeder)
        $barData = [
            \App\Models\CounselorReview::where('counselor_id', $counselor->id)->avg('rating_comfort') ?? 5.0,
            \App\Models\CounselorReview::where('counselor_id', $counselor->id)->avg('rating_impact') ?? 5.0,
            \App\Models\CounselorReview::where('counselor_id', $counselor->id)->avg('rating_safety') ?? 5.0,
            \App\Models\CounselorReview::where('counselor_id', $counselor->id)->avg('rating_accessibility') ?? 5.0,
            \App\Models\CounselorReview::where('counselor_id', $counselor->id)->avg('rating_relationship') ?? 5.0,
        ];

        return view('booking', compact('counselor', 'pieData', 'barData'));
    }
    public function storeBooking(Request $request)
    {
        // 1. Validasi Input Kiriman dari Form
        $request->validate([
            'counselor_id'   => 'required|exists:counselors,id',
            'booking_method' => 'required|in:chat,video',
            'booking_date'   => 'required|date|after_or_equal:today',
            'booking_time'   => 'required|string',
            'client_notes'   => 'nullable|string|max:1000',
        ]);

        // 2. Simpan ke database dan TAMPUNG hasilnya ke dalam variabel $booking
        $booking = Booking::create([
            'user_id'        => Auth::id(), 
            'counselor_id'   => $request->counselor_id,
            'booking_method' => $request->booking_method,
            'booking_date'   => $request->booking_date,
            'booking_time'   => $request->booking_time,
            'client_notes'   => $request->client_notes,
            'penerimaan'     => 'belum',          
            'status'         => 'belum diterima', 
        ]);

        // 3. Alihkan langsung ke rute status dengan mengambil ID dari data yang baru dibuat
        return redirect()->route('dashboard.booking.status', ['id' => $booking->id])
                         ->with('success', 'Reservasi berhasil dikirim!');
    
    }
    public function bookingStatus($id)
    {
        // Cari data booking berdasarkan ID yang dikirim melalui URL
        // Pastikan booking tersebut milik user yang sedang login agar aman (security check)
        $booking = Booking::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->with('counselor') // Eager load data konselornya sekaligus
                          ->firstOrFail();

        // Mengembalikan ke file view menunggu-persetujuan.blade.php sambil membawa data $booking
        return view('menunggu-persetujuan', compact('booking'));
    }
    public function cancelBooking($id)
    {
        // Cari data booking berdasarkan ID dan pastikan itu milik user yang sedang login (keamanan data)
        $booking = Booking::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        // Hapus data dari database
        $booking->delete();

        // Alihkan kembali ke halaman dashboard utama dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Permintaan konseling berhasil dibatalkan.');
    }
    public function acceptBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Ubah kolom penerimaan menjadi 'sudah' dan status menjadi 'sesi aktif'
        $booking->update([
            'penerimaan' => 'sudah',
            'status'     => 'sesi aktif'
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan bimbingan berhasil diterima!');
    }

    /**
     * Menolak Permintaan Booking (Menghapus data booking)
     */
    public function rejectBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Permintaan bimbingan telah ditolak dan dihapus.');
    }
        public function finishBooking($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->update([
            'status' => 'selesai'
        ]);

        return redirect()->route('dashboard')->with('success', 'Sesi konseling telah selesai diarsipkan!');
    }
    public function activeSession($id)
    {
        // Cari data booking berdasarkan ID yang statusnya 'sesi aktif' ATAU 'selesai'
        $booking = Booking::where('id', $id)
                        ->whereIn('status', ['sesi aktif', 'selesai'])
                        ->with(['user', 'counselor.user'])
                        ->firstOrFail();

        return view('sesi-aktif', compact('booking'));
    }
    public function storeUxFeedback(Request $request)
    {
        $request->validate([
            'kemudahan_1' => 'required|integer|between:1,5',
            'kejelasan'   => 'required|integer|between:1,5',
            'kemudahan_2' => 'required|integer|between:1,5',
            'kecepatan'   => 'required|integer|between:1,5',
            'kebergunaan' => 'required|integer|between:1,5',
            'ux_feedback' => 'nullable|string|max:1000',
        ]);

        \App\Models\UxOverview::create([
            'user_id'     => Auth::id(),
            'kemudahan'   => $request->kemudahan_1, // Pemetaan dari form
            'kejelasan'   => $request->kejelasan,
            'dayatarik'   => $request->kemudahan_2, // Contoh pemetaan: Navigasi -> Dayatarik
            'kecepatan'   => $request->kecepatan,
            'kebergunaan' => $request->kebergunaan,
            'catatan'     => $request->ux_feedback,
        ]);

        return response()->json(['success' => true, 'message' => 'Feedback berhasil disimpan!']);
    }
}