<?php

namespace App\DataTables;

use App\Models\Faq;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FaqsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Faq $faq) {
                return view('admin.faqs.columns._actions', compact('faq'));
            })
            ->setRowId('id');
    }

    public function query(Faq $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('faqs-table')
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
            Column::make('id')->title('ID')->width('10%'),
            Column::make('question_en')->title('Question (English)')->width('auto'),
            Column::make('question_ar')->title('السؤال (العربية)')->width('auto'),
            Column::make('answer_en')->title('Answer (English)')->width('auto'),
            Column::make('answer_ar')->title('الإجابة (العربية)')->width('auto'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('15%')
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Faqs_' . date('YmdHis');
    }
}
