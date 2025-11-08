<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class SuspendedByAdminUsersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('d/m/Y');
            })
            ->addColumn('action', function (User $user) {
                return view('admin.suspendedByAdmin.columns._actions', compact('user'));
            })
            ->setRowId('id');
    }

    public function query(User $model)
    {
        return $model->newQuery()
            ->where('status', 'inactive') // ✅ your new status
            ->withCount('reportsReceived'); // optional: only if this relation exists
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('suspended-by-admin-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'reports_received_count' => [
                'title' => 'Report Count',
                'data' => 'reports_received_count',
                'searchable' => false,
            ],
            'created_at',
            'status',
            'action',
        ];
    }

    protected function filename(): string
    {
        return 'SuspendedByAdminUsers_' . date('YmdHis');
    }
}
