<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UxOverview extends Model
{
    use HasFactory;

    protected $table = 'ux_overviews';

    protected $fillable = [
        'user_id',
        'kemudahan',
        'kejelasan',
        'dayatarik',
        'kecepatan',
        'kebergunaan',
        'catatan',
    ];

    /**
     * Relasi ke model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}