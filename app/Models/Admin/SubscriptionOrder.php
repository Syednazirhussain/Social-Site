<?php

namespace App\Models\Admin;

use Eloquent as Model;

use Carbon\Carbon;

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
class SubscriptionOrder extends Model
{

    public $table = 'subscription_orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $timestamps = true;



    public $fillable = [
        'user_id',
        'subscription_plan_id',
        'transaction_id',
        'amount',
        'status'
        // 'code',
        // 'user_id',
        // 'membership_id',
        // 'status',
        // 'renewal_date',
        // 'renewed_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'subscription_plan_id' => 'integer',
        'transaction_id' => 'string',
        'amount' => 'double',
        'status' => 'string'
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
        return $this->belongsTo(\App\User::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function subscription()
    {
        return $this->belongsTo(\App\Models\Admin\Subscription::class,'subscription_plan_id','id');
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F d, Y');
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
    
}
