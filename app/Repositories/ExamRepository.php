<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Repositories\BaseRepository;

/**
 * Class ExamRepository
 * @package App\Repositories
 * @version June 22, 2019, 11:01 am UTC
*/

class ExamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'docx_file',
        'pdf_file',
        'header_title',
        'duration',
        'total_marks',
        'daytime',
        'exam_date',
        'questions_count',
        'pages_count',
        'header_instructions',
        'type',
        'user_id',
        'created_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Exam::class;
    }
}
