<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Topic
 * @package App\Models
 * @version June 22, 2019, 10:51 am UTC
 *
 * @property \App\Models\Subject subject
 * @property string title
 * @property integer subject_id
 * @property string created_at
 */
class Topic extends Model
{
    use SoftDeletes;

    public $table = 'topics';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'subject_id',
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'subject_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function subject()
    {
        return $this->hasOne(\App\Models\Subject::class, 'id', 'subject_id');
    }


    public function questions()
    {
        return $this->hasMany(\App\Models\Question::class);
    }
}
