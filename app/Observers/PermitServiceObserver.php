<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\PermitService;
use Illuminate\Support\Facades\Auth;

class PermitServiceObserver
{
    public function created(PermitService $permitService): void
    {
        $this->logActivity($permitService, 'created', $permitService->toArray());
    }

    public function updated(PermitService $permitService): void
    {
        // Hanya ambil data yang berubah (changes)
        $payload = [
            'old' => $permitService->getOriginal(),
            'new' => $permitService->getChanges(),
        ];
        $this->logActivity($permitService, 'updated', $payload);
    }

    public function deleted(PermitService $permitService): void
    {
        $this->logActivity($permitService, 'deleted', $permitService->toArray());
    }

    /**
     * Handle the PermitService "restored" event.
     */
    public function restored(PermitService $permitService): void
    {
        //
    }

    /**
     * Handle the PermitService "force deleted" event.
     */
    public function forceDeleted(PermitService $permitService): void
    {
        //
    }

    protected function logActivity($model, $action, $payload)
    {
        ActivityLog::create([
            'model' => get_class($model),
            'model_id' => $model->id,
            'action' => $action,
            'payload' => json_encode($payload),
            'user_id' => Auth::id(),
        ]);
    }
}
