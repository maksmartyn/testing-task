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
    
    
    /**
     * Attributes that should not be included in the array and JSON view of the model.
     *
     * @var array
     */
    protected $hidden = [
        'worker_id'
    ];

    
    /**
     * Append accessors of attribute that should be included in the array and JSON view of the model.
     *
     * @var array
     */
    protected $appends = [
        'worker'
    ];

    
    /**
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo('App\Models\Worker');
    }

    
    /**
     *  Append ralated attribute.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function getWorkerAttribute()
    {
        return $this->worker()->get();    
    }
}
