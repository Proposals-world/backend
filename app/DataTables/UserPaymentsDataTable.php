<?php

namespace App\DataTables;

use App\Models\UserPayment;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserPaymentsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function (UserPayment $payment) {
                // If user_id = -1 or 999999999 → invalid email
                if ($payment->user_id == -1 || $payment->user_id == 999999999) {
                    return '<span class="text-danger font-weight-bold">Invalid email given</span>';
                }

                // Check if user exists to avoid null error
                if ($payment->user) {
                    return '<a href="' . route('userprofile', $payment->user->id) . '" class="primary-text">'
                        . e($payment->user->first_name . ' ' . $payment->user->last_name) . '</a>';
                }

                // Fallback if relation missing
                return '<span class="text-muted">User not found</span>';
            })

            ->addColumn('package_name', function (UserPayment $payment) {
                return $payment->package ? $payment->package->package_name_en : '-';
            })
            ->editColumn('status', function (UserPayment $payment) {
                return ucfirst($payment->status); // make status readable
            })
            ->addColumn('action', function (UserPayment $payment) {
                return view('admin.userPayments.columns._actions', compact('payment'));
            })
            ->setRowId('id')
            ->rawColumns(['user_name', 'action']); // allow HTML for the link
    }

    public function query(UserPayment $model)
    {
        return $model->with(['user', 'package'])->select('user_payments.*');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('userpayments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '150px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'id' => ['title' => 'ID'],
            'user_name' => ['title' => 'User'],
            'package_name' => ['title' => 'Package'], // ✅ show package name
            'email' => ['title' => 'Email'],
            'amount' => ['title' => 'Amount'],
            'date' => ['title' => 'Date'],
            'status' => ['title' => 'Status'],
            // 'action' => ['title' => 'Actions', 'orderable' => false, 'searchable' => false],
        ];
    }

    protected function filename(): string
    {
        return 'UserPayments_' . date('YmdHis');
    }
}
