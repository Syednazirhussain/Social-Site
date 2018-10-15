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
class Permission extends Model
{

    public $table = 'permissions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function modelHasPermission()
    {
        return $this->hasOne(\App\Models\Admin\ModelHasPermission::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Admin\Role::class, 'role_has_permissions');
    }
}
