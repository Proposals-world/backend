<?php

namespace App\DataTables;

use App\Models\Subscription;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class YearlySubscriptionSalesDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('year', function ($data) {
                return $data->year;
            })
            ->addColumn('total_subscriptions', function ($data) {
                return number_format($data->total_subscriptions);
            })
            ->addColumn('total_revenue', function ($data) {
                return '$' . number_format($data->total_revenue, 2);
            })
            ->setRowId('year')
            ->rawColumns(['year', 'total_subscriptions', 'total_revenue']);
    }


    public function query(Subscription $model)
    {
        $query = $model->with(['package' => function ($query) {
            $query->select('id', 'price');
        }])
            ->selectRaw("
                YEAR(subscriptions.created_at) as year,
                COUNT(*) as total_subscriptions,
                SUM(subscription_packages.price) as total_revenue
            ")
            ->leftJoin('subscription_packages', 'subscriptions.package_id', '=', 'subscription_packages.id')
            ->whereNotIn('subscriptions.package_id', [999, 1000]) // ✅ exclude free packages
            ->groupBy('year')
            ->orderBy('year', 'desc');

        return $this->applyScopes($query);
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('yearly-subscription-sales-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
                'order' => [[0, 'desc']]
            ]);
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'year',
                'title' => 'Year',
                'searchable' => false,
                'orderable' => true
            ],
            [
                'data' => 'total_subscriptions',
                'title' => 'Subscriptions',
                'searchable' => false,
                'orderable' => true
            ],
            [
                'data' => 'total_revenue',
                'title' => 'Revenue',
                'searchable' => false,
                'orderable' => true
            ]
        ];
    }

    protected function filename(): string
    {
        return 'YearlySubscriptionSales_' . date('YmdHis');
    }
}
