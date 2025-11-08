<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\SuspendedByAdminUsersDataTable;
use Illuminate\Http\Request;

class SuspendedByAdminUserController extends Controller
{
    /**
     * Display the Suspended by Admin Users DataTable.
     */
    public function index(SuspendedByAdminUsersDataTable $dataTable)
    {
        return $dataTable->render('admin.suspendedByAdmin.index');
    }
}
