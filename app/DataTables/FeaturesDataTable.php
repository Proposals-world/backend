<?php

namespace App\DataTables;

use App\Models\Feature;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class FeaturesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Feature $feature) {
                return view('admin.feature.columns._actions', compact('feature'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Feature $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('features-table')
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
        return 'Features_' . date('YmdHis');
    }
}
