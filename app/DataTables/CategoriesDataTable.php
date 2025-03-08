<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Category $category) {
                return view('admin.categories.columns._actions', compact('category'));
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Category $model)
    {
        return $model->newQuery()->select('id', 'name_en', 'name_ar', 'slug', 'created_at', 'updated_at');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('categories-table')
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
            'name_en' => ['title' => 'Category Name (English)'],
            'name_ar' => ['title' => 'Category Name (Arabic)'],
        ];
    }

    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}