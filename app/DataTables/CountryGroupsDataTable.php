<?php

// app/DataTables/CountryGroupsDataTable.php
namespace App\DataTables;

use App\Models\CountryGroup;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CountryGroupsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (CountryGroup $countryGroup) {
                return view('admin.CountryGroups.columns._actions', compact('countryGroup'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(CountryGroup $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('country-groups-table')
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
        ];
    }

    protected function filename(): string
    {
        return 'CountryGroups_' . date('YmdHis');
    }
}
