<?php

namespace App\DataTables;

use App\Models\PaymentTransaction;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentTransactionDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('full_name', function (PaymentTransaction $transaction) {
                return $transaction->user->first_name . ' ' . $transaction->user->last_name;
            })
            ->addColumn('subscription_type', function (PaymentTransaction $transaction) {
                return $transaction->subscription->package->package_name_en ?? 'N/A';
            })
            ->editColumn('amount', function (PaymentTransaction $transaction) {
                return number_format($transaction->amount, 2) . ' ' . $transaction->currency;
            })
            ->editColumn('created_at', function (PaymentTransaction $transaction) {
                return $transaction->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('status', function (PaymentTransaction $transaction) {
                $status = strtolower($transaction->status);
                $badgeClass = $status === 'completed' ? 'badge bg-success' : ($status === 'pending' ? 'badge bg-warning' : 'badge bg-danger');
                return '<span class="' . $badgeClass . '">' . ucfirst($status) . '</span>';
            })
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    public function query(PaymentTransaction $model)
    {
        return $model->newQuery()
            ->with([
                'user',
                'subscription',
                'subscription.package' => function ($query) {
                    $query->select('id', 'package_name_en');
                }
            ])
            ->select('payment_transactions.*');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('payment-transactions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0, 'desc')
            ->buttons([])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('5%'),
            Column::make('full_name')->title('User')->width('15%'),
            Column::make('user.gender')->title('Gender')->width('10%'),
            Column::make('subscription_type')->title('Subscription')->width('15%'),
            Column::make('amount')->title('Amount')->width('10%'),
            Column::make('payment_method')->title('Method')->width('10%'),
            Column::make('status')->title('Status')->width('10%'),
            Column::make('created_at')->title('Date')->width('15%'),
        ];
    }

    protected function filename(): string
    {
        return 'PaymentTransactions_' . date('YmdHis');
    }
}
