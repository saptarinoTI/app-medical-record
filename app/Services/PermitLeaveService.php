<?php

namespace App\Services;

use App\Models\PermitService;
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
}