<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FwateerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Fwateer;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf; // if you use barryvdh/laravel-dompdf

class FwateerController extends Controller
{
    public function index(FwateerDataTable $dataTable)
    {
        return $dataTable->render('admin.fwateer.index');
    }
    public function exportPdf()
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');

        $query = Fwateer::with(['user', 'package'])->orderByDesc('id');

        // ✅ Apply the same filters from DataTable
        if (request()->filled('filterMonth')) {
            $query->whereMonth('invoice_date', request('filterMonth'));
        }

        if (request()->filled('filterYear')) {
            $query->whereYear('invoice_date', request('filterYear'));
        }

        if (request()->filled('search') && isset(request('search')['value'])) {
            $search = request('search')['value'];
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($sub) use ($search) {
                        $sub->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            });
        }

        $fwateerList = $query->get();

        if ($fwateerList->isEmpty()) {
            return back()->with('error', 'No invoices match your filters.');
        }

        $html = '<style>
        .page-break { page-break-after: always; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    </style>';

        foreach ($fwateerList as $fwateer) {
            $user = $fwateer->user;
            $package = $fwateer->package;
            $price = $fwateer->amount;
            $start = $fwateer->invoice_date ?? $fwateer->created_at;
            $end = $start?->copy()->addMonth();
            $isMale = $user && $user->gender === 'male';
            $contacts = $isMale ? 5 : null;
            $months = !$isMale ? 1 : null;

            $html .= View::make('emails.subscription.invoice', compact(
                'fwateer',
                'user',
                'package',
                'price',
                'start',
                'end',
                'isMale',
                'contacts',
                'months'
            ))->render();

            $html .= '<div class="page-break"></div>';
        }

        $pdf = Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setWarnings(false);

        return $pdf->stream('Filtered_Invoices_' . now()->format('Ymd_His') . '.pdf');
    }

    public function singlePdf($id)
    {
        ini_set('max_execution_time', 120);
        ini_set('memory_limit', '512M');

        $fwateer = Fwateer::with(['user', 'package'])->findOrFail($id);
        $user = $fwateer->user;
        $package = $fwateer->package;
        $price = $fwateer->amount;
        $start = $fwateer->invoice_date;
        $end = $fwateer->invoice_date->copy()->addMonth();
        $isMale = $user && $user->gender === 'male';
        $contacts = $isMale ? 5 : null;
        $months = !$isMale ? 1 : null;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.subscription.invoice', compact(
            'fwateer',
            'user',
            'package',
            'price',
            'start',
            'end',
            'isMale',
            'contacts',
            'months'
        ))->setPaper('a4', 'portrait')->setWarnings(false);

        return $pdf->stream("Invoice_{$fwateer->invoice_number}.pdf");
    }
}
