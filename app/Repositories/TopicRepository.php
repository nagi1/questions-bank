<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Repositories\BaseRepository;

/**
 * Class TopicRepository
 * @package App\Repositories
 * @version June 22, 2019, 10:51 am UTC
*/

class TopicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'subject_id',
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
        return Topic::class;
    }
}
