<?php

namespace App\Models;

use App\Models\Topic;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subjects
 * @package App\Models
 * @version June 22, 2019, 10:41 am UTC
 *
 * @property \App\Models\User user
 * @property string title
 * @property string department
 * @property string code
 * @property string level
 * @property integer total_marks
 * @property string faculty
 * @property integer user_id
 */
class Subject extends Model
{
    use SoftDeletes;

    public $table = 'subjects';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'department',
        'code',
        'level',
        'total_marks',
        'faculty',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'department' => 'string',
        'code' => 'string',
        'level' => 'string',
        'total_marks' => 'integer',
        'faculty' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'department' => 'required',
        'code' => 'required',
        'level' => 'required',
        'total_marks' => 'required',
        'faculty' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

    public function topics()
    {
        return $this->hasMany(\App\Models\Topic::class);
    }
}
