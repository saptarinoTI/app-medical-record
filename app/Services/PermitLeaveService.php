<?php

namespace App\Services;

use App\Models\PermitService;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PermitLeaveService
{
    public function expireIfNeeded(): void
    {
        $today = Carbon::today();

        $expiredLeaves = PermitService::where('status', 'active')
            ->whereDate('permit_end', '<', $today)
            ->get();

        if ($expiredLeaves->isEmpty()) {
            return;
        }

        DB::transaction(function () use ($expiredLeaves) {
            foreach ($expiredLeaves as $leave) {
                $leave->update([
                    'status' => 'expired'
                ]);
            }
        });
    }

    /* Query Filter Izin */
    public function getPermits($filters, $perPage = 1)
    {
        return PermitService::query()
            ->with('service')
            ->where('status', 'active')
            ->when($filters['search'] ?? null, 
                fn ($q, $search) => $q->search($search)
            )
            ->orderBy('permit_start')
            ->paginate($perPage);
    }

    /* Query Permit Service Sumary */
    public function getPermitLeaveSumary()
    {
        return [
            'total_service_active' => Service::query()->where('is_active', true)->count(),
            'service_on_leave' => PermitService::query()->where('status', 'active')->count(),
            'total_specialist' => Service::query()->where('is_active', true)->distinct('specialist')->count('specialist')
        ];
    }
}