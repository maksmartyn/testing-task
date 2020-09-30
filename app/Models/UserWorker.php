<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorker extends Model
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
        'login',
        'name',
        'email',
        'image',
        'about',
        'type',
        'github',
    ];
    
    public function worker()
    {
        return $this->hasOne('App\Models\Worker');
    }
}
