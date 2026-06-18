<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Counselor extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit
    protected $table = 'counselors';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'user_id',
        'slug',
        'initials',
        'name',
        'specialization',
        'description',
        'satisfaction',
    ];

    /**
     * Relasi ke model CounselorReview.
     * Satu konselor memiliki banyak review/ulasan dari mahasiswa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function reviews(): HasMany
    {
        // Menghubungkan id konselor ke kolom 'counselor_id' di tabel counselor_reviews
        return $this->hasMany(CounselorReview::class, 'counselor_id');
    }
    
}