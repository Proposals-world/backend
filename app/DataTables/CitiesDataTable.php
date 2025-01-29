<?php

namespace App\DataTables;

use App\Models\City;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class CitiesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('country', function (City $city) {
                return $city->country->name_en; // Adjust based on country table fields
            })
            ->addColumn('action', function (City $city) {
                return view('admin.city.columns._actions', compact('city'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(City $model)
    {
        return $model->newQuery()->with('country');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('cities-table')
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
            'country' => ['title' => 'Country'],
            'created_at',
            'updated_at',
        ];
    }

    protected function filename(): string
    {
        return 'Cities_' . date('YmdHis');
    }
}
