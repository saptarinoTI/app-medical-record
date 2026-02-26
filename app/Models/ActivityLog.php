<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'model_id',
        'action',
        'payload',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'payload' => 'array', // Mengubah JSON di DB menjadi Array PHP secara otomatis
        'model_id' => 'integer',
    ];

    /**
     * Helper untuk mendapatkan nama class model saja (tanpa namespace).
     * Contoh: "App\Models\PermitService" menjadi "PermitService"
     */
    public function getShortModelNameAttribute(): string
    {
        return class_basename($this->model);
    }
}
