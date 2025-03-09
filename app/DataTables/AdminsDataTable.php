<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class AdminsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (User $admin) {
                return view('admin.users.admins.columns._actions', compact('admin'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(User $model)
    {
        return $model->where('role_id', 1)->select('id', 'first_name', 'last_name', 'email', 'created_at');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('admins-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'id' => ['title' => 'ID'],
            'first_name' => ['title' => 'First Name'],
            'last_name' => ['title' => 'Last Name'],
            'email' => ['title' => 'Email'],
        ];
    }

    protected function filename(): string
    {
        return 'Admins_' . date('YmdHis');
    }
}