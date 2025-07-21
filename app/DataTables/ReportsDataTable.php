<?php

namespace App\DataTables;

use App\Models\UserReport;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class ReportsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->editColumn('reporter_id', function ($report) {
                return $report->reporter->first_name . ' ' . $report->reporter->last_name;
            })
            ->editColumn('reported_id', function ($report) {
                return $report->reported->first_name . ' ' . $report->reported->last_name;
            })
            ->editColumn('reason', function ($report) {
                return $report->reason_en;
            })
            ->addColumn('status_badge', function ($report) {
                $status = strtolower($report->status);
                $badgeClass = match ($status) {
                    'pending' => 'badge bg-warning',
                    'reviewed' => 'badge bg-info',
                    'resolved' => 'badge bg-success',
                    'rejected' => 'badge bg-danger',
                    default => 'badge bg-secondary'
                };
                return '<span class="' . $badgeClass . '">' . ucfirst($report->status) . '</span>';
            })
            ->addColumn('action', function (UserReport $report) {
                return view('admin.reports.columns._actions', compact('report'));
            })
            ->setRowId('id')
            ->rawColumns(['status_badge', 'action']);
    }

    public function query(UserReport $model)
    {
        return $model->newQuery()->with(['reporter', 'reported']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('reports-table')
            ->columns($this->getColumns())
            ->orderBy(1)
            ->addAction(['title' => 'Actions', 'width' => '120px'])
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('reporter_id')->title('Reporter'),
            Column::make('reported_id')->title('Reported'),
            Column::make('reason_en')->title('Reason'),
            Column::computed('status_badge')
                ->title('Status')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Reports_' . date('YmdHis');
    }
}
