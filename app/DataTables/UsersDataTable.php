<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('d/m/Y');
            })
            ->addColumn('action', function (User $user) {
                return view('admin.AdminUser.columns._actions', compact('user'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(User $model)
    {
        return $model->newQuery()
            ->where('role_id', '!=', 1);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['create', 'export', 'print', 'reset', 'reload'],
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
            'profile_status',
            'gender',
            'status',
            'created_at',
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
