<?php

namespace App\DataTables;

use App\Models\Report;
use App\Models\UserReport;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;

class ReportsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return EloquentDataTable
     */
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
                return $report->reason_en; // Format this field based on the language if needed
            })
            ->editColumn('status', function ($report) {
                return ucfirst($report->status); // Capitalize the first letter of the status
            })
            ->addColumn('action', function (UserReport $report) {
                return view('admin.reports.columns._actions', compact('report'));
            })
            ->setRowId('id')
            ->rawColumns(['action']); // Ensure raw HTML is handled properly for action column
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(UserReport $model)
    {
        return $model->newQuery()->with(['reporter', 'reported']); // Eager load the reporter and reported relationships
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('reports-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->addAction(['title' => 'Actions', 'width' => '120px'])
            ->selectStyleSingle()
            ->buttons([
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the DataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('reporter_id')->title('Reporter'),
            Column::make('reported_id')->title('Reported'),
            Column::make('reason_en')->title('Reason'),
            Column::make('status')->title('Status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Reports_' . date('YmdHis');
    }
}
