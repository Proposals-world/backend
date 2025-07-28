<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriptionSalesDataTable;
use App\Http\Controllers\Controller;

class MonthlySubscriptionSalesController extends Controller
{
    public function index(SubscriptionSalesDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriptionSales.index');
    }
}
