<?php

namespace App\DataTables;

use App\Models\MarriageBudget;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class MarriageBudgetsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (MarriageBudget $marriageBudget) {
                return view('admin.marriageBudgets.columns._actions', compact('marriageBudget'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(MarriageBudget $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('marriage-budgets-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Actions', 'width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['create', 'export', 'print', 'reset', 'reload'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'budget_en',
            'budget_ar',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename(): string
    {
        return 'MarriageBudgets_' . date('YmdHis');
    }
}
