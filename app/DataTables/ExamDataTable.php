<?php

namespace App\DataTables;

use App\Models\Exam;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ExamDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'exams.datatables_actions')
            ->addColumn('subject', function (Exam $exam) {
                return $exam->subject->title;
            })->addColumn('user_id', function (Exam $exam) {
                return $exam->user->name;
            })->addColumn('download', function (Exam $exam) {
                switch ($exam->type) {
                    case 'midterm':
                    case 'final':
                        return '<a class="btn btn-success" href=\''.route('exam.download', ['exam_id'=> $exam->id ]).'\'>Download</a>';
                        break;

                    case 'quiz':
                    case 'assignment':
                        return '<a class="btn btn-success" href=\''.route('other.download', ['exam_id'=> $exam->id ]).'\'>Download</a>';
                        break;

                }
            })->rawColumns(['download', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Exam $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Exam $model)
    {
        return $model->newQuery()->orderBy('created_at', 'desc');

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom' => 'Bfrtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner'],
                ],
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
            'subject',
            'type',
            'user_id',
            'total_marks',
            'exam_date',
            'created_at',
            'download',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'examsdatatable_' . time();
    }
}
