<?php

namespace App\Repositories;

use App\Models\Question_type;
use App\Repositories\BaseRepository;

/**
 * Class Question_typeRepository
 * @package App\Repositories
 * @version June 22, 2019, 10:31 am UTC
*/

class Question_typeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'head_text',
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
        return Question_type::class;
    }
}
