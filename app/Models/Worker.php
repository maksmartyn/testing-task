<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /**
     * Specifies whether timestamps are required for the model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Attributes for which mass assignment is allowed.
     *
     * @var array
     */
    protected $fillable = [
        'adopted_at'
    ];

    public function department()
    {
        return $this->hasOne('App\Models\Department');
    }
    
    public function position()
    {
        return $this->hasOne('App\Models\WorkPosition');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\UserWorker');
    }
}
