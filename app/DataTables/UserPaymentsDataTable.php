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
                if ($payment->user_id == -1 || $payment->user_id == 999999999) {
                    return '<span class="text-danger font-weight-bold">Invalid email given</span>';
                }

                if ($payment->user) {
                    return '<a href="' . route('userprofile', $payment->user->id) . '" class="primary-text">'
                        . e($payment->user->first_name . ' ' . $payment->user->last_name) . '</a>';
                }

                return '<span class="text-muted">User not found</span>';
            })

            ->addColumn('package_name', function (UserPayment $payment) {
                return $payment->package ? e($payment->package->package_name_en) : '-';
            })

            // ✅ Editable Reference Number
            ->addColumn('reference_number', function (UserPayment $payment) {
                return '
                    <input type="text"
                           class="form-control form-control-sm ref-input"
                           data-id="' . $payment->id . '"
                           value="' . e($payment->reference_number ?? '') . '"
                           placeholder="Reference #">
                ';
            })

            // ✅ Editable Final Amount
            ->addColumn('final_amount', function (UserPayment $payment) {
                return '
                    <input type="number"
                           step="0.01"
                           min="0"
                           class="form-control form-control-sm amount-input"
                           data-id="' . $payment->id . '"
                           value="' . e($payment->final_amount ?? '') . '"
                           placeholder="0.00">
                ';
            })

            // ✅ Buttons Column (Save + Verify)
            ->addColumn('actions', function (UserPayment $payment) {
                $referenceFilled = !empty($payment->reference_number);
                $amountFilled = !empty($payment->final_amount);
                $bothFilled = $referenceFilled && $amountFilled;

                // Always show Save button
                $buttons = '
        <button class="btn btn-sm btn-success save-payment" data-id="' . $payment->id . '">
            Save
        </button>
    ';

                // ✅ Show Verify button only if both fields are filled
                if ($bothFilled) {
                    if ($payment->status === 'pending') {
                        // Active verify
                        $buttons .= '
                <button
                    class="btn btn-sm btn-primary ms-1 subscribe-btn"
                    data-email="' . e($payment->email) . '"
                    data-package-id="' . e($payment->package->id ?? '') . '"
                    data-payment-id="' . e($payment->id) . '"
                >
                    Verify subscription
                </button>
            ';
                    } elseif ($payment->status === 'paid') {
                        // Disabled verified
                        $buttons .= '
                <button
                    class="btn btn-sm btn-secondary ms-1"
                    disabled
                    title="Already verified and paid"
                >
                    Verified
                </button>
            ';
                    }
                }

                return '<div class="d-flex align-items-center">' . $buttons . '</div>';
            })

            ->editColumn('status', function (UserPayment $payment) {
                return ucfirst($payment->status);
            })

            ->setRowId('id')
            ->rawColumns(['user_name', 'reference_number', 'final_amount', 'actions']);
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
            ->orderBy(0)
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
            'package_name' => ['title' => 'Package'],
            'email' => ['title' => 'Email'],
            'amount' => ['title' => 'Amount'],
            'reference_number' => ['title' => 'Reference Number'],
            'final_amount' => ['title' => 'Final Amount'],
            'date' => ['title' => 'Date'],
            'status' => ['title' => 'Status'],
            'actions' => ['title' => 'Actions', 'orderable' => false, 'searchable' => false],
        ];
    }

    protected function filename(): string
    {
        return 'UserPayments_' . date('YmdHis');
    }
}
