<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SuspendedUsersDataTable;
use App\Http\Controllers\Controller;

class SuspendedUserController extends Controller
{
    public function index(SuspendedUsersDataTable $dataTable)
    {
        return $dataTable->render('admin.suspendedUsers.index');
    }
}
