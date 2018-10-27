<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class Permission
 * @package App\Models\Admin
 * @version October 13, 2018, 12:34 pm UTC
 *
 * @property \App\Models\Admin\ModelHasPermission modelHasPermission
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string guard_name
 */
class AdditionalInfo extends Model
{

    public $table = 'additional_info';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'user_id',
        'about_us',
        'facebook',
        'instagram',
        'linkdin',
        'twitter'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
        'about_us'  => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->hasMany(\App\User::class,'user_id','id');
    }
}
