<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  schema="UserWorker",
 *  @OA\Property(
 *      property="user",
 *      ref="#/components/schemas/User"
 *  ),
 *  @OA\Property(
 *      property="worker",
 *      ref="#/components/schemas/Worker"
 *  )
 * )
 */
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
        'user_id',
        'worker_id',
    ];

    
    /**
     * Append accessors of attribute that should be included in the array and JSON view of the model.
     *
     * @var array
     */
    protected $appends = [
        'worker',
        'user'
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
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
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


    /**
     *  Append ralated attribute.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function getUserAttribute()
    {
        return $this->user()->get();    
    }
}
