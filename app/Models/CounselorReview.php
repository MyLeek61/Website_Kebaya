<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounselorReview extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit
    protected $table = 'counselor_reviews';

    // Kolom-kolom hasil form review mahasiswa yang diizinkan masuk ke database
    protected $fillable = [
        'counselor_id',
        'user_id',
        'case_category',
        'rating_comfort',
        'rating_impact',
        'rating_safety',
        'rating_accessibility',
        'rating_relationship',
        'rating_average',
        'review_text',
    ];

    /**
     * Relasi ke model Counselor.
     * Setiap baris ulasan dipastikan hanya merujuk ke satu konselor.
     */
    public function counselor(): BelongsTo
    {
        return $this->belongsTo(Counselor::class, 'counselor_id');
    }

    /**
     * Relasi ke model User (Mahasiswa).
     * Setiap baris ulasan ditulis oleh satu user mahasiswa yang terautentikasi.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}