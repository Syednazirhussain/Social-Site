<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \MaddHatter\LaravelFullcalendar\IdentifiableEvent;

/**
 * Class Event
 * @package App\Models
 * @version November 29, 2018, 12:31 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection chatterDiscussion
 * @property \Illuminate\Database\Eloquent\Collection chatterPost
 * @property \Illuminate\Database\Eloquent\Collection chatterUserDiscussion
 * @property \Illuminate\Database\Eloquent\Collection follow
 * @property \Illuminate\Database\Eloquent\Collection posts
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property \Illuminate\Database\Eloquent\Collection subscription
 * @property integer user_id
 * @property string title
 * @property boolean allDay
 * @property string|\Carbon\Carbon start
 * @property string|\Carbon\Carbon end
 * @property string parameters
 */
class Event extends Model implements IdentifiableEvent
{
    use SoftDeletes;

    public $table = 'events';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'title',
        'allDay',
        'start',
        'end',
        'parameters'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'title' => 'string',
        'allDay' => 'boolean',
        'parameters' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Get the event's ID
     *
     * @return int|string|null
     */
    public function getId();

    
}
