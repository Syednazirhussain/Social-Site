<?php

namespace App\Models;

use Eloquent as Model;



use \MaddHatter\LaravelFullcalendar\Event as EventInterface;

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
class Event extends Model implements EventInterface
{


    public $table = 'events';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';





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

    protected $dates = ['start', 'end'];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    public function getStartAttribute($value)
    {
        return date("Y-m-d", strtotime($value));
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function user()
    {
        return $this->hasOne(\App\User::class,'id','user_id');
    }
    
}
