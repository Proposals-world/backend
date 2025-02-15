<?php

namespace App\DataTables;

use App\Models\Religion;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ReligionsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Religion $religion) {
                return view('admin.religions.columns._actions', compact('religion'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Religion $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('religions-table')
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
        return 'Religions_' . date('YmdHis');
    }
}
