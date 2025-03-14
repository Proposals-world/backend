<?php

namespace App\DataTables;

use App\Models\Blog;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class BlogsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('categories', function (Blog $blog) {
                return $blog->categories->pluck('name_en')->implode(', ');
            })
            ->addColumn('action', function (Blog $blog) {
                return view('admin.blogs.columns._actions', compact('blog'));
            })
            ->editColumn('image', function (Blog $blog) {
                return '<img src="' . $blog->image_url . '" height="50"/>';
            })
            ->setRowId('id')
            ->rawColumns(['categories', 'action', 'image']);
    }

    public function query(Blog $model)
    {
        return $model->newQuery()->with('categories')->select('id', 'image', 'title_en', 'title_ar', 'status', 'views');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('blogs-table')
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
            'image' => ['title' => 'Image'],
            'title_en' => ['title' => 'Title (English)'],
            'title_ar' => ['title' => 'Title (Arabic)'],
            'categories' => ['title' => 'Categories'],
            'status' => ['title' => 'Status'],
            'views' => ['title' => 'Views'],
        ];
    }

    protected function filename(): string
    {
        return 'Blogs_' . date('YmdHis');
    }
}