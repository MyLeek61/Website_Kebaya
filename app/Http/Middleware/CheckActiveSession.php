<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Cari apakah user (mahasiswa) ini memiliki booking yang statusnya sudah 'sesi aktif'
            $activeBooking = Booking::where('user_id', Auth::id())
                                    ->where('status', 'sesi aktif')
                                    ->first();

            // Jika ada sesi aktif, langsung alihkan ke halaman sesi-aktif
            if ($activeBooking) {
                // Kita akan arahkan ke rute bernama 'dashboard.booking.active' membawa ID bookingnya
                return redirect()->route('dashboard.booking.active', ['id' => $activeBooking->id])
                                 ->with('info', 'Anda memiliki sesi konseling yang sedang berjalan.');
            }
        }

        return $next($request);
    }
}