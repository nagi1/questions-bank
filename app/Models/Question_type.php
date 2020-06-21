<?php

namespace App\Models;

use App\Models\Question;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question_type
 * @package App\Models
 * @version June 22, 2019, 10:31 am UTC
 *
 * @property string name
 * @property integer head_text
 */
class Question_type extends Model
{
    use SoftDeletes;

    public $table = 'question_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'head_text'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'head_text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'head_text' => 'required'
    ];




    
}
