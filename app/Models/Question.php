<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 * @package App\Models
 * @version June 22, 2019, 11:18 am UTC
 *
 * @property string question
 * @property string ilos
 * @property integer marks
 * @property integer subject_id
 * @property integer topic_id
 * @property integer user_id
 * @property string choice1
 * @property string choice2
 * @property string choice3
 * @property string choice4
 * @property string answer
 * @property string created_at
 * @property string correct
 */
class Question extends Model
{
    use SoftDeletes;

    public $table = 'questions';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'question',
        'ilos',
        'marks',
        'subject_id',
        'topic_id',
        'user_id',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'answer',
        'created_at',
        'correct',
        'type_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question' => 'string',
        'ilos' => 'string',
        'marks' => 'integer',
        'subject_id' => 'integer',
        'type_id' => 'integer',
        'topic_id' => 'integer',
        'user_id' => 'integer',
        'choice1' => 'string',
        'choice2' => 'string',
        'choice3' => 'string',
        'choice4' => 'string',
        'answer' => 'string',
        'correct' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }

    public function type()
    {
        return $this->belongsTo('App\QuestionType');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


}
