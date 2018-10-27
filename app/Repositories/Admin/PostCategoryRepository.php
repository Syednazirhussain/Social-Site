<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PostCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostCategoryRepository
 * @package App\Repositories\Admin
 * @version October 19, 2018, 11:45 am UTC
 *
 * @method PostCategory findWithoutFail($id, $columns = ['*'])
 * @method PostCategory find($id, $columns = ['*'])
 * @method PostCategory first($columns = ['*'])
*/
class PostCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostCategory::class;
    }
}
