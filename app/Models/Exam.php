<?php

namespace App\Models;

use App\Models\User;
use Eloquent as Model;
use Plank\Metable\Metable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Exam
 * @package App\Models
 * @version June 22, 2019, 11:01 am UTC
 *
 * @property \App\Models\User user
 * @property string docx_file
 * @property string pdf_file
 * @property string header_title
 * @property string duration
 * @property string total_marks
 * @property string daytime
 * @property string exam_date
 * @property integer questions_count
 * @property integer pages_count
 * @property string header_instructions
 * @property string type
 * @property integer user_id
 * @property string created_at
 */
class Exam extends Model
{
    use SoftDeletes;
    use Metable;

    public $table = 'exams';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
        'subject_id',
        'created_at',
        'show'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'docx_file' => 'string',
        'pdf_file' => 'string',
        'header_title' => 'string',
        'duration' => 'string',
        'total_marks' => 'string',
        'daytime' => 'string',
        'questions_count' => 'integer',
        'pages_count' => 'integer',
        'header_instructions' => 'string',
        'type' => 'string',
        'subject_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function user()
    {
        return $this->BelongsTo(\App\Models\User::class);
    }

    public function subject()
    {
        return $this->BelongsTo(\App\Models\Subject::class);
    }

}
