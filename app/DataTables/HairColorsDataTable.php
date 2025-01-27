<?php

namespace App\DataTables;

use App\Models\HairColor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HairColorsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (HairColor $hairColor) {
                return view('admin.hairColors.columns._actions', compact('hairColor'))->render();
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(HairColor $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('hair-colors-table')
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
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'HairColors_' . date('YmdHis');
    }
}
