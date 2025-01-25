<?php

namespace App\DataTables;

use App\Models\Country;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CountriesDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Country $country) {
                return view('admin.countries.columns._actions', compact('country'));
            })
            ->setRowId('id');
    }

    public function query(Country $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('countries-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->autoWidth(true) // Enable auto width for the table
            ->addTableClass('table table-hover table-bordered table-striped align-middle')
            ->orderBy(0);
    }
    
    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('10%'), // Set width percentage or fixed value
            Column::make('name_en')->title('Name (English)')->width('auto'),
            Column::make('name_ar')->title('Name (Arabic)')->width('auto'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('15%') // Action column width for buttons
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Countries_' . date('YmdHis');
    }
}