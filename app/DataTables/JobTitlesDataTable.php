<?php

namespace App\DataTables;

use App\Models\JobTitle;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class JobTitlesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (JobTitle $jobTitle) {
                return view('admin.Job title.columns._actions', compact('jobTitle'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(JobTitle $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('job-titles-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['create', 'export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            'id',
            'name_en' => ['title' => 'Name (English)'],
            'name_ar' => ['title' => 'Name (Arabic)'],
        ];
    }

    protected function filename(): string
    {
        return 'JobTitles_' . date('YmdHis');
    }
}
