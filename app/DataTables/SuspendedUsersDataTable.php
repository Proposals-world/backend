<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class SuspendedUsersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('d/m/Y');
            })
            ->addColumn('action', function (User $user) {
                return view('admin.suspendedUsers.columns._actions', compact('user'));
            })
            ->setRowId('id');
    }

    public function query(User $model)
    {
        return $model->newQuery()
            ->where('status', 'suspended') // or whatever your suspended status value is
            ->withCount('reportsReceived'); // if you want to show report count
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('suspended-users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns()
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
                'searchable' => false
            ],
            'created_at',
            'status',
            'action'
        ];
    }

    protected function filename(): string
    {
        return 'SuspendedUsers_' . date('YmdHis');
    }
}
