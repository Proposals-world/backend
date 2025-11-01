<?php

namespace App\Http\Controllers\Log;

use App\DataTables\Log\UserProfileLogsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UserProfileLogController extends Controller
{
    public function index(UserProfileLogsDataTable $dataTable)
    {
        return $dataTable->render('admin.logs.UserProfile.index');
    }
    // public function data()
    // {
    //     $path = storage_path('logs/user_profile.log');

    //     if (!File::exists($path)) {
    //         return datatables()->of([])->make(true);
    //     }

    //     $lines = array_reverse(File::lines($path)->toArray());

    //     $records = [];
    //     foreach ($lines as $line) {
    //         // Example log pattern:
    //         // [2025-01-12 10:23:45] local.INFO: User profile updated {"user_id":123,...}
    //         preg_match('/^\[(.*?)\]\s+\w+\.\w+:\s+(.*)$/', $line, $matches);

    //         $date = $matches[1] ?? '';
    //         $message = $matches[2] ?? $line;

    //         $records[] = [
    //             'date' => $date,
    //             'message' => $message,
    //         ];
    //     }

    //     return datatables()->of($records)->make(true);
    // }
    public function data(UserProfileLogsDataTable $dataTable)
    {
        return $dataTable->ajax();
    }
}
