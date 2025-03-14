<?php

namespace App\DataTables;

use App\Models\DrinkingStatus;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class DrinkingStatusesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (DrinkingStatus $drinkingStatus) {
                return view('admin.drinkingStatus.columns._actions', compact('drinkingStatus'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(DrinkingStatus $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('drinking-statuses-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['create', 'export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'name_en',
            'name_ar',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename(): string
    {
        return 'DrinkingStatuses_' . date('YmdHis');
    }
}
