<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
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
        'name'
    ];

    
    /**
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne('App\Models\Worker');
    }
}
