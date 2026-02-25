<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlotService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'days',
        'start_time',
        'end_time',
        'quota',
        'information',
    ];

    protected $casts = [
        'days' => 'array', // Memungkinkan penyimpanan multiple days
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
