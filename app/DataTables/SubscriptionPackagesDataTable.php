<?php

namespace App\DataTables;

use App\Models\SubscriptionPackage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SubscriptionPackagesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('duration_display', function (SubscriptionPackage $subscriptionPackage) {
                return ($subscriptionPackage->duration == 0)
                    ? 'No duration for male'
                    : $subscriptionPackage->duration;
            })
            ->addColumn('contact_limit_display', function (SubscriptionPackage $subscriptionPackage) {
                return ($subscriptionPackage->contact_limit == 0)
                    ? 'No contact for female'
                    : $subscriptionPackage->contact_limit;
            })
            ->addColumn('gender', fn(SubscriptionPackage $p) => ucfirst($p->gender ?? ''))
            ->addColumn('is_special_offer_display', function (SubscriptionPackage $subscriptionPackage) {
                return $subscriptionPackage->is_special_offer ? 'Yes' : 'No';
            })
            ->addColumn('is_default_display', function (SubscriptionPackage $subscriptionPackage) {
                return $subscriptionPackage->is_default ? 'Yes' : 'No';
            })
            ->addColumn('hide_package_display', function (SubscriptionPackage $subscriptionPackage) {
                return $subscriptionPackage->hide_package ? 'Yes' : 'No';
            })

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
                'name' => 'contact_limit',
            ],
            [
                'data' => 'duration_display',
                'title' => 'Duration',
                'name' => 'duration',
            ],
            'gender',
            [
                'data' => 'is_special_offer_display',
                'title' => 'Special Offer',
                'name' => 'is_special_offer',
            ],
            [
                'data' => 'is_default_display',
                'title' => 'Default',
                'name' => 'is_default',
            ],

            // ✅ NEW COLUMN
            [
                'data' => 'hide_package_display',
                'title' => 'Hidden',
                'name' => 'hide_package',
            ],
        ];
    }

    protected function filename(): string
    {
        return 'Subs_' . date('YmdHis');
    }
}
