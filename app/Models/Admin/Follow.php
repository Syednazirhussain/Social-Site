<?php

namespace App\Models\Admin;

use Eloquent as Model;


/**
 * Class PostCategory
 * @package App\Models\Admin
 * @version October 19, 2018, 11:45 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Post
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string description
 */
class Follow extends Model
{
   

    public $table = 'follow';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'follower_id' => 'integer',
        'followed_id' => 'integer'
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
