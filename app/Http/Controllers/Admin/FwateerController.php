<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FwateerDataTable;
use App\Http\Controllers\Controller;

class FwateerController extends Controller
{
    public function index(FwateerDataTable $dataTable)
    {
        return $dataTable->render('admin.fwateer.index');
    }
}
