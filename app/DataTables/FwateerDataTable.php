<?php

namespace App\DataTables;

use App\Models\Fwateer;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class FwateerDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', function (Fwateer $fwateer) {
                $user = $fwateer->user;
                if (!$user) return '<span class="text-muted">N/A</span>';

                $url = route('userprofile', $user->id); // Changed route to userprofile
                return '<a href="' . $url . '" class="text-primary fw-bold">'
                    . $user->first_name . ' ' . $user->last_name . '</a>';
            })
            ->addColumn('action', function (Fwateer $fwateer) {
                return view('admin.fwateer.columns._actions', compact('fwateer'));
            })
            ->editColumn('invoice_date', fn($fwateer) => $fwateer->invoice_date ? $fwateer->invoice_date->format('Y-m-d') : '—')
            ->editColumn('amount', fn($fwateer) => number_format($fwateer->amount, 2) . ' JOD')
            ->setRowId('id')
            ->rawColumns(['action', 'user']);
    }

    public function query(Fwateer $model)
    {
        $query = $model->newQuery()->with('user');

        // ✅ Handle optional filters manually using request()
        $month = request('month');
        $year = request('year');

        if (!empty($month)) {
            $query->whereMonth('invoice_date', $month);
        }
        if (!empty($year)) {
            $query->whereYear('invoice_date', $year);
        }

        // ✅ If no filters applied → return all
        return $query->select([
            'id',
            'company_name',
            'invoice_number',
            'invoice_date',
            'amount',
            'payment_method',
            'user_id',
        ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('fwateer-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => [
                    ['extend' => 'excel', 'text' => '<i class="fa fa-file-excel"></i> Excel', 'className' => 'btn btn-success btn-sm'],
                    ['extend' => 'csv', 'text' => '<i class="fa fa-file-csv"></i> CSV', 'className' => 'btn btn-info btn-sm'],
                    // ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> Print', 'className' => 'btn btn-secondary btn-sm'],
                    // ['extend' => 'reset', 'text' => '<i class="fa fa-undo"></i> Reset', 'className' => 'btn btn-warning btn-sm'],
                    // ['extend' => 'reload', 'text' => '<i class="fa fa-sync"></i> Reload', 'className' => 'btn btn-primary btn-sm'],
                ],
                'order' => [[0, 'desc']],
            ]);
    }


    protected function getColumns()
    {
        return [
            'id' => ['title' => 'ID'],
            'company_name' => ['title' => 'Company Name'],
            'invoice_number' => ['title' => 'Invoice #'],
            'invoice_date' => ['title' => 'Issue Date'],
            'amount' => ['title' => 'Amount'],
            'payment_method' => ['title' => 'Payment Method'],
            'user' => ['title' => 'User'],
        ];
    }

    protected function filename(): string
    {
        return 'Fwateer_' . date('YmdHis');
    }
}
