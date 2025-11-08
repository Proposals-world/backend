<?php

namespace App\DataTables;

use App\Models\TermsAndCondition;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class TermsAndConditionsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (TermsAndCondition $term) {
                return view('admin.terms.columns._actions', compact('term'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(TermsAndCondition $model)
    {
        return $model->newQuery()
            ->select('id', 'title_en', 'title_ar', 'version', 'effective_date', 'is_active', 'created_at', 'updated_at');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('terms-table')
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
            'id' => ['title' => 'ID'],
            'title_en' => ['title' => 'Title (EN)'],
            'title_ar' => ['title' => 'Title (AR)'],
            'version' => ['title' => 'Version'],
            'effective_date' => ['title' => 'Effective Date'],
            'is_active' => ['title' => 'Active'],
        ];
    }

    protected function filename(): string
    {
        return 'TermsAndConditions_' . date('YmdHis');
    }
}
