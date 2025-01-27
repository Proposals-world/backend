<?php

namespace App\DataTables;

use App\Models\Origin;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OriginsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Origin $origin) {
                return view('admin.origins.columns._actions', compact('origin'));
            })
            ->setRowId('id');
    }

    public function query(Origin $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('origins-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->autoWidth(true)
            ->addTableClass('table table-hover table-bordered table-striped align-middle')
            ->orderBy(0);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('10%'),
            Column::make('name_en')->title('Name (English)')->width('auto'),
            Column::make('name_ar')->title('Name (Arabic)')->width('auto'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('15%')
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Origins_' . date('YmdHis');
    }
}
