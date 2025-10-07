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
            ->addColumn('duration_display', function (SubscriptionPackage $subscriptionPackage) {
                // Display "No duration" if duration is 0 for male
                return ($subscriptionPackage->duration == 0)
                    ? 'No duration for male'
                    : $subscriptionPackage->duration;
            })
            ->addColumn('contact_limit_display', function (SubscriptionPackage $subscriptionPackage) {
                // Display "No contact" if contact_limit is 0 for female
                return ($subscriptionPackage->contact_limit == 0)
                    ? 'No contact for female'
                    : $subscriptionPackage->contact_limit;
            })
            ->addColumn('gender', fn(SubscriptionPackage $p) => ucfirst($p->gender ?? ''))
            ->addColumn('action', function (SubscriptionPackage $subscriptionPackage) {
                return view('admin.SubscriptionPackage.columns._actions', compact('subscriptionPackage'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }


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
            'package_name_en',
            'package_name_ar',
            'price',
            [
                'data' => 'contact_limit_display',
                'title' => 'Contact Limit',
                'name' => 'contact_limit' // Keep original column name for sorting/filtering
            ],
            [
                'data' => 'duration_display',
                'title' => 'Duration',
                'name' => 'duration' // Keep original column name for sorting/filtering
            ],
            'gender',
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
