<?php

namespace App\DataTables;

use App\Models\Specialization;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class SpecializationsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Specialization $specialization) {
                return view('admin.specializations.columns._actions', compact('specialization'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Specialization $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('specializations-table')
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
        ];
    }

    protected function filename(): string
    {
        return 'Specializations_' . date('YmdHis');
    }
}
