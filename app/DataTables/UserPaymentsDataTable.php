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

            // ✅ Show Payment Type with colored badge
            ->addColumn('payment_type', function (UserPayment $payment) {
                if (empty($payment->payment_type)) {
                    return '<span class="badge badge-light text-muted">Unknown</span>';
                }

                $type = strtolower($payment->payment_type);
                $label = ucfirst($type);
                $color = match ($type) {
                    'visa' => 'success',
                    'cliq' => 'info',
                    'mastercard' => 'primary',
                    'fintesa' => 'warning',
                    default => 'secondary',
                };

                return '<span class="badge badge-' . $color . '">' . e($label) . '</span>';
            })

            // ✅ Show uploaded photo (only for CliQ)
            ->addColumn('photo_url', function (UserPayment $payment) {
                if ($payment->payment_type !== 'cliq') {
                    return '<span class="text-muted">Photos only for CliQ payments</span>';
                }

                if (empty($payment->photo_url)) {
                    return '<span class="text-warning">No photo uploaded</span>';
                }

                $url = asset('storage/' . $payment->photo_url);
                return '
                <a href="' . $url . '" target="_blank">
                    <img src="' . $url . '" alt="Payment Screenshot"
                         style="width:60px; height:60px; object-fit:cover; border-radius:6px; border:1px solid #ccc;">
                </a>
            ';
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
            })->addColumn('gender', function (UserPayment $payment) {
                if ($payment->user && $payment->user->gender) {
                    return e(ucfirst($payment->user->gender)); // Male / Female
                }

                return 'N/A';
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

            // ✅ Actions (Save + Verify)
            ->addColumn('actions', function (UserPayment $payment) {
                $referenceFilled = !empty($payment->reference_number);
                $amountFilled = !empty($payment->final_amount);
                $bothFilled = $referenceFilled && $amountFilled;

                $buttons = '
                <button class="btn btn-sm btn-success save-payment" data-id="' . $payment->id . '">
                    Save
                </button>
            ';

                if ($bothFilled) {
                    if ($payment->status === 'pending') {
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

            ->editColumn('status', fn(UserPayment $payment) => ucfirst($payment->status))
            // ✅ Gender Column (English only)

            ->setRowId('id')
            ->rawColumns(['user_name', 'gender', 'photo_url', 'reference_number', 'final_amount', 'actions']);
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
            'email' => ['title' => 'Email'],
            'gender' => ['title' => 'Gender'],
            'package_name' => ['title' => 'Package'],
            'amount' => ['title' => 'Amount'],
            'date' => ['title' => 'Date'],
            'photo_url' => ['title' => 'Photo'],
            'reference_number' => ['title' => 'Reference number'],
            'final_amount' => ['title' => 'Final amount'],
            'status' => ['title' => 'Status'],
            'actions' => ['title' => 'Actions', 'orderable' => false, 'searchable' => false],
        ];
    }



    protected function filename(): string
    {
        return 'UserPayments_' . date('YmdHis');
    }
}
