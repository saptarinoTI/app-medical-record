<?php

namespace App\Http\Controllers;

use App\Models\PermitService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LogPermitServicePrintController extends Controller
{
    public function print()
    {
        // dd(request()->query());
        $query = PermitService::query();

        $filters = request('filters', []);

        $start  = $filters['permit_date']['permit_start'] ?? null;
        $end    = $filters['permit_date']['permit_end'] ?? null;
        $status = $filters['status']['value'] ?? null;

        // default dari table kamu memang != active
        $query->where('status', '!=', 'active');

        if ($status) {
            $query->where('status', $status);
        }

        if ($start) {
            $query->whereDate('permit_start', '>=', $start);
        }

        if ($end) {
            $query->whereDate('permit_end', '<=', $end);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('pdf.log-permit-services', compact('data'));

        return $pdf->stream('log-permit-services.pdf');
    }
}
