<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subscription
 * @package App\Models\Admin
 * @version October 22, 2018, 9:00 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection posts
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string code
 * @property decimal price
 * @property string status
 */
class Subscription extends Model
{
    use SoftDeletes;

    public $table = 'subscription';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'plan_code',
        'user_id',
        'status',
        'renewal_date',
        'renewed_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plan_code' => 'string',
        'user_id' => 'integer',
        'status' => 'string',
        'renewal_date' => 'date:Y-m-d',
        'renewed_date' => 'date:Y-m-d'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\User::class);
    }
    
}
