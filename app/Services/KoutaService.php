<?php

namespace App\Services;

use App\Models\SlotService;

class KoutaService
{
    /* Query Filter Izin */
    public function getSlots($filters, $perPage = 1)
    {
        return SlotService::query()
            ->with('service')
            ->when(
                $filters['search'] ?? null,
                fn($q, $search) => $q->search($search)
            )
            ->latest()
            ->paginate($perPage);
    }
}
