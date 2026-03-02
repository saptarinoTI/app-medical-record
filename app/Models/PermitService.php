<?php

namespace App\Models;

use Carbon\Carbon;
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

    // Scope Search
    public function scopeSearch($query, $value)
    {
        $query->where(function ($q) use ($value) {
            $q->whereHas('service', function ($service) use ($value) {
                $service->where('name', 'like', "%{$value}%")
                    ->orWhere('specialist', 'like', "%{$value}%");
            });
        });
    }

    /* Scope Waktu Aktif */
    public function scopeActiveToday($query)
    {
        $now = now();

        return $query->whereDate('permit_start', '<=', $now)
            ->whereDate('permit_end', '>=', $now);
    }
}
