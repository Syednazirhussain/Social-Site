<?php

namespace App\Repositories\Admin;

use App\Models\Admin\MemberShipPlan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MemberShipPlanRepository
 * @package App\Repositories\Admin
 * @version October 22, 2018, 9:00 am UTC
 *
 * @method MemberShipPlan findWithoutFail($id, $columns = ['*'])
 * @method MemberShipPlan find($id, $columns = ['*'])
 * @method MemberShipPlan first($columns = ['*'])
*/
class MemberShipPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'price',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MemberShipPlan::class;
    }
}
