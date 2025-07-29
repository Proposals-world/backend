<?php

namespace App\DataTables;

use App\Models\UserFeedback;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SuccessStoriesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('user1_info', function (UserFeedback $feedback) {
                $user1 = $feedback->match->user1;
                return view('admin.SuccessStories.columns._user_info', [
                    'user' => $user1,
                    'gender' => $user1->gender
                ])->render();
            })
            ->addColumn('user2_info', function (UserFeedback $feedback) {
                $user2 = $feedback->match->user2;
                return view('admin.SuccessStories.columns._user_info', [
                    'user' => $user2,
                    'gender' => $user2->gender
                ])->render();
            })
            ->addColumn('outcome', function (UserFeedback $feedback) {
                $locale = app()->getLocale();
                return $locale === 'ar' ? $feedback->feedback_text_ar : $feedback->feedback_text_en;
            })
            ->editColumn('created_at', function (UserFeedback $feedback) {
                return $feedback->created_at->format('Y-m-d H:i');
            })
            ->filterColumn('user1_info', function ($query, $keyword) {
                $query->whereHas('match.user1', function ($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%")
                        ->orWhere('last_name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('user2_info', function ($query, $keyword) {
                $query->whereHas('match.user2', function ($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%")
                        ->orWhere('last_name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('outcome', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('feedback_text_en', 'like', "%{$keyword}%")
                        ->orWhere('feedback_text_ar', 'like', "%{$keyword}%");
                });
            })
            ->setRowId('id')
            ->rawColumns(['user1_info', 'user2_info', 'outcome', 'created_at']);
    }

    public function query(UserFeedback $model)
    {
        return $model->newQuery()
            ->with(['match.user1', 'match.user2'])
            ->whereIn('feedback_text_en', ['Engagement Happened', 'Marriage Happened'])
            ->select('user_feedback.*');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('success-stories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
                'order' => [[0, 'desc']],
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                'language' => [
                    'search' => '_INPUT_',
                    'searchPlaceholder' => 'Search...',
                ],
                // 'initComplete' => "function() {
                //     this.api().columns().every(function() {
                //         var column = this;
                //         if ($(column.header()).hasClass('searchable')) {
                //             var input = document.createElement('input');
                //             $(input).appendTo($(column.header()).empty())
                //                 .on('keyup change', function() {
                //                     column.search($(this).val(), false, false, true).draw();
                //                 });
                //         }
                //     });
                // }"
            ]);
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'id',
                'title' => 'ID',
                'width' => '5%',
                'className' => 'text-center',
                'searchable' => true
            ],
            [
                'data' => 'user1_info',
                'title' => 'User 1',
                'width' => '25%',
                'className' => 'user-info-column searchable',
                'orderable' => true
            ],
            [
                'data' => 'user2_info',
                'title' => 'User 2',
                'width' => '25%',
                'className' => 'user-info-column searchable',
                'orderable' => true
            ],
            [
                'data' => 'outcome',
                'title' => 'Outcome',
                'width' => '20%',
                'className' => 'text-center searchable'
            ],
            [
                'data' => 'created_at',
                'title' => 'Date',
                'width' => '15%',
                'className' => 'text-center',
                'searchable' => true
            ]
        ];
    }

    protected function filename(): string
    {
        return 'SuccessStories_' . date('YmdHis');
    }
}
