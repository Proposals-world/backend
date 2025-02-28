<?php

namespace App\DataTables;

use App\Models\Sub;
use App\Models\SubscriptionPackage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SubscriptionPackagesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return EloquentDataTable
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function (SubscriptionPackage $subscriptionPackage) {
                // Make sure the view path matches your folder structure
                return view('admin.SubscriptionPackage.columns._actions', compact('subscriptionPackage'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @param Sub $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionPackage $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('subscription-package-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['create', 'export', 'print', 'reset', 'reload'],
            ]);
    }

    /**
     * Get the DataTable columns definition.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'package_name_en', // use the correct column name
            'package_name_ar', // use the correct column name
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get the filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Subs_' . date('YmdHis');
    }
}
