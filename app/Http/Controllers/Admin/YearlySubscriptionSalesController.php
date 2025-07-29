<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\YearlySubscriptionSalesDataTable;
use App\Http\Controllers\Controller;

class YearlySubscriptionSalesController extends Controller
{
    public function index(YearlySubscriptionSalesDataTable $dataTable)
    {
        return $dataTable->render('admin.yearlySubscriptionSales.index');
    }
}
