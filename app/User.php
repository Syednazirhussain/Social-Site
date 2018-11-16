<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'phone',
        'status',
        'plan_code',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function additional_info()
    {
        return $this->belongsTo(\App\Models\Admin\AdditionalInfo::class,'id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function memberShip()
    {
        return $this->belongsTo(\App\Models\Admin\MemberShipPlan::class,'plan_code','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function follow()
    {
        return $this->belongsTo(\App\Models\Admin\MemberShipPlan::class,'id','follower_id','followed_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    **/
    public function posts()
    {
        return $this->hasMany(\App\Models\Admin\Post::class,'id','user_id');
    }


}
