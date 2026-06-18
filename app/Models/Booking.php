<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'counselor_id',
        'booking_method',
        'booking_date',
        'booking_time',
        'client_notes',
        'penerimaan',
        'status',
    ];
    public function counselor()
    {
        return $this->belongsTo(Counselor::class, 'counselor_id');
    }

    /**
     * Relasi ke model User (Satu booking dimiliki oleh satu mahasiswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}