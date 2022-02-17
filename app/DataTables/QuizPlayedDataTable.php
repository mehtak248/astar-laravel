<?php

namespace App\DataTables;

use App\Models\Quiz;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QuizPlayedDataTable extends DataTable
{
    protected $with = ['users'];

    protected $i = 1;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('rank', function () {
                return $this->i++;
            })
            ->addColumn('name', function (Quiz $quiz) {
                return $quiz->user->name;
            })
            ->addColumn('email', function (Quiz $quiz) {
                return $quiz->user->email;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Quiz $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quiz $model)
    {
        $startDate = $this->request()->get('startDate');
        $endDate = $this->request()->get('endDate');

        $query = $model::select(\DB::raw('quizzes.id, user_id, max(score) as score'))
            ->where('score', '>', 0);

        if (!empty($startDate) && !empty($endDate)) {
            $query
                ->whereBetween('created_at', [
                    Carbon::parse($startDate)->toDateTimeString(),
                    Carbon::parse($endDate)->toDateTimeString(),
                ]);
        }

        $query
            ->groupBy('user_id')
            ->orderBy('score', 'desc');

        return $query->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('quizplayed-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'buttons' => ['csv'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('rank'),
            Column::make('name'),
            Column::make('email'),
            Column::make('score'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'QuizPlayed_' . date('YmdHis');
    }
}
