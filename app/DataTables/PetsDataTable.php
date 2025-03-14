<?php

namespace App\DataTables;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PetsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Pet $pet) {
                return view('admin.pets.columns._actions', compact('pet'))->render();
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Pet $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('pets-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom'       => 'Bfrtip',
                'buttons'   => ['create', 'export', 'print', 'reset', 'reload'],
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

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pets_' . date('YmdHis');
    }
}
