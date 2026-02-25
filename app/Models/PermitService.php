<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermitService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'permit_start',
        'permit_end',
        'back',
        'reason',
        'status',
    ];

    protected $casts = [
        'permit_start' => 'date',
        'permit_end' => 'date',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
