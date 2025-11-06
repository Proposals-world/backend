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

                $url = route('userprofile', $user->id);
                return '<a href="' . $url . '" class="text-primary fw-bold">'
                    . e($user->first_name . ' ' . $user->last_name) . '</a>';
            })
            ->addColumn('action', function (Fwateer $fwateer) {
                return view('admin.fwateer.columns._actions', compact('fwateer'));
            })
            ->editColumn('invoice_date', fn($fwateer) => $fwateer->invoice_date ? $fwateer->invoice_date->format('Y-m-d') : '—')
            ->addColumn('package', function (Fwateer $fwateer) {
                return $fwateer->package?->package_name_en ?? '<span class="text-muted">N/A</span>';
            })
            ->editColumn('amount', fn($fwateer) => number_format($fwateer->amount, 2) . ' JOD')
            ->setRowId('id')
            ->rawColumns(['action', 'user', 'package']);
    }

    public function query(Fwateer $model)
    {
        $query = $model->newQuery()->with(['user', 'package']);

        if (request('month')) {
            $query->whereMonth('invoice_date', request('month'));
        }
        if (request('year')) {
            $query->whereYear('invoice_date', request('year'));
        }

        return $query->select([
            'id',
            'company_name',
            'invoice_number',
            'invoice_date',
            'amount',
            'payment_method',
            'reference_number',
            'user_id',
            'package_id',
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
                    [
                        'extend' => 'excel',
                        'text' => '<i class="fa fa-file-excel"></i> Export as Excel',
                        'className' => 'btn btn-success btn-sm',
                    ],
                    // [
                    //     'extend' => 'csv',
                    //     'text' => '<i class="fa fa-file-csv"></i> CSV',
                    //     'className' => 'btn btn-info btn-sm',
                    // ],
                    [
                        'text' => '<i class="fa fa-file-pdf"></i> Export as PDF',
                        'className' => 'btn btn-danger btn-sm',
                        'action' => "function (e, dt, node, config) {
                        let params = dt.ajax.params();
                        params.filterMonth = $('#filterMonth').val();
                        params.filterYear = $('#filterYear').val();
                        let query = $.param(params);
                        window.open('" . route('admin.fwateer.export.pdf') . "?' + query, '_blank');
                    }",
                    ],
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
            'reference_number' => ['title' => 'Reference #'],
            'package' => ['title' => 'Package'],
            'payment_method' => ['title' => 'Payment Method'],
            'user' => ['title' => 'User'],
        ];
    }

    protected function filename(): string
    {
        return 'Fwateer_' . date('YmdHis');
    }
}
