<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models\Admin
 * @version October 19, 2018, 12:40 pm UTC
 *
 * @property \App\Models\Admin\User user
 * @property \App\Models\Admin\PostCategory postCategory
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer user_id
 * @property integer post_category_id
 * @property string post_type
 * @property string title
 * @property string description
 * @property string image
 * @property string status
 */
class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'post_category_id',
        'post_type',
        'title',
        'description',
        'image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_category_id' => 'integer',
        'post_type' => 'string',
        'title' => 'string',
        'description' => 'string',
        'image' => 'string',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Admin\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function postCategory()
    {
        return $this->belongsTo(\App\Models\Admin\PostCategory::class);
    }
}
