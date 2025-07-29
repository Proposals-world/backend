<?php

namespace App\DataTables;

use App\Models\ContactMessage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContactMessagesDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (ContactMessage $msg) {
                // if you need a specific timezone: ->timezone('Asia/Amman')
                return $msg->created_at->format('d/m/Y H:i');
            })
            ->setRowId('id');
    }

    public function query(ContactMessage $model)
    {
        return $model->newQuery()->select([
            'id',
            'name',
            'email',
            'phone',
            'message',
            'created_at'
        ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('contact-messages-table')
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
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Phone'),
            Column::make('message')->title('Message')->width('30%'),
            Column::make('created_at')->title('Sent At'),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width('10%')
            //     ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'ContactMessages_' . date('YmdHis');
    }
}
