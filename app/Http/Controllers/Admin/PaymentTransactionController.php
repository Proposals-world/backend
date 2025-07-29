<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentTransactionDataTable;
use App\Http\Controllers\Controller;

class PaymentTransactionController extends Controller
{
    public function index(PaymentTransactionDataTable $dataTable)
    {
        return $dataTable->render('admin.payments.index');
    }
}
