<?php

namespace App\DataTables;

use App\Models\EducationalLevel;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class EducationalLevelsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (EducationalLevel $educationalLevel) {
                return view('admin.educationalLevels.columns._actions', compact('educationalLevel'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(EducationalLevel $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('educational-levels-table')
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
            'name_en' => ['title' => 'Name (English)'],
            'name_ar' => ['title' => 'Name (Arabic)'],
            'created_at',
            'updated_at',
        ];
    }

    protected function filename(): string
    {
        return 'EducationalLevels_' . date('YmdHis');
    }
}
