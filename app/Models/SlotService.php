<?php

namespace App\Models;

use Carbon\Carbon;
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

    /* Func Untuk Atur Waktu */
    public function getTimePeriodAttribute()
    {
        if (!$this->start_time) return null;

        $start = Carbon::parse($this->start_time)->format('H:i');

        if ($start >= '07:00' && $start <= '12:00') {
            return 'Pagi';
        }

        if ($start >= '12:01' && $start <= '18:00') {
            return 'Sore';
        }

        if ($start >= '18:01' && $start <= '23:00') {
            return 'Malam';
        }

        return 'Diluar Jadwal';
    }

    /* Format jam */
    public function getFormattedTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->start_time)->format('H:i')
            . ' - ' .
            \Carbon\Carbon::parse($this->end_time)->format('H:i');
    }
}
