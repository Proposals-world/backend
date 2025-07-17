<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RedeemDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('full_name', function (User $user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->addColumn('package_name', function (User $user) {
                return $user->subscription ?
                    ($user->subscription->package->package_name_en ?? 'No Package') :
                    'No Subscription';
            })
            ->addColumn('contact_limit', function (User $user) {
                return $user->subscription ?
                    ($user->subscription->package->contact_limit ?? 'N/A') :
                    'N/A';
            })
            ->addColumn('status_badge', function (User $user) {
                $status = $user->subscription->status ?? 'inactive';
                $badgeClass = $status === 'active' ? 'badge bg-success' : 'badge bg-danger';
                return '<span class="' . $badgeClass . '">' . ucfirst($status) . '</span>';
            })
            ->addColumn('action', function (User $user) {
                return view('admin.redeem.columns._actions', compact('user'));
            })
            ->rawColumns(['status_badge', 'action'])
            ->setRowId('id');
    }

    public function query(User $model)
    {
        return $model->newQuery()
            ->where('gender', 'male')
            ->with([
                'subscription',
                'subscription.package' => function ($query) {
                    $query->select('id', 'package_name_en', 'contact_limit');
                }
            ])
            ->select([
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.gender'
            ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('redeem-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->autoWidth(true)
            ->addTableClass('table table-hover table-bordered table-striped align-middle')
            ->orderBy(0);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('5%'),
            Column::make('full_name')->title('Full Name')->width('15%'),
            Column::make('email')->title('Email')->width('20%'),
            Column::make('package_name')->title('Package Name')->width('15%'),
            Column::make('contact_limit')->title('Contact Limit')->width('10%'),
            Column::make('subscription.contacts_remaining')->title('Contacts Remaining')->width('10%'),
            Column::make('status_badge')->title('Status')->width('10%'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('15%')
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Redeem_' . date('YmdHis');
    }
}
