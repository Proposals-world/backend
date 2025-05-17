<?php

namespace App\DataTables;

use App\Models\UserFeedback;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FeedbacksDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable(
            // eager‐load user + both sides of the match
            $query->with(['user', 'match.user1', 'match.user2'])
        ))
            // flat column for who submitted
            ->addColumn('given_by', function (UserFeedback $fb) {
                return optional($fb->user)->first_name
                    . ' ' . optional($fb->user)->last_name;
            })
            // flat column for the *other* user in that match
            ->addColumn('matched_with', function (UserFeedback $fb) {
                $match = $fb->match;
                if (! $match) {
                    return '';
                }
                // whichever side is not the feedback->user_id
                $other = $match->user1_id === $fb->user_id
                    ? $match->user2
                    : $match->user1;
                return $other
                    ? ($other->first_name . ' ' . $other->last_name)
                    : '';
            })
            ->addColumn(
                'action',
                fn(UserFeedback $fb) =>
                view('admin.feedback.columns._actions', compact('fb'))
            )
            ->setRowId('id');
    }

    public function query(UserFeedback $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('feedbacks-table')
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
            Column::make('match_id')->title('Match ID')->width('8%'),
            Column::make('given_by')->title('Given By')->width('15%'),
            Column::make('matched_with')->title('Matched With')->width('15%'),
            Column::make('is_profile_accurate')->title('Accurate?')->width('8%'),
            Column::make('feedback_text_en')->title('Feedback (EN)')->width('15%'),
            Column::make('feedback_text_ar')->title('Feedback (AR)')->width('15%'),
            Column::make('outcome')->title('Outcome')->width('10%'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('9%')
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Feedbacks_' . date('YmdHis');
    }
}
