<?php

namespace App\DataTables;

use App\Models\Hobby;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class HobbiesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Hobby $hobby) {
                return view('admin.hobbies.columns._actions', compact('hobby'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Hobby $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('hobbies-table')
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
        return 'Hobbies_' . date('YmdHis');
    }
}
