<?php

namespace App\Repositories;

use App\Models\Job;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobRepository
 * @package App\Repositories
 * @version November 24, 2018, 8:51 pm UTC
 *
 * @method Job findWithoutFail($id, $columns = ['*'])
 * @method Job find($id, $columns = ['*'])
 * @method Job first($columns = ['*'])
*/
class JobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'bio',
        'avatar',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Job::class;
    }
}
