<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  schema="Worker",
 *  @OA\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="department",
 *      ref="#/components/schemas/Department"
 *  ),
 *  @OA\Property(
 *      property="position",
 *      ref="#/components/schemas/WorkPosition"
 *  ),
 *  @OA\Property(
 *      property="adopted_at",
 *      type="string"
 *  )
 * )
 */
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


    /**
     * Attributes that should not be included in the array and JSON view of the model.
     *
     * @var array
     */
    protected $hidden = [
        'department_id',
        'position_id'
    ];


    /**
     * Append accessors of attribute that should be included in the array and JSON view of the model.
     *
     * @var array
     */
    protected $appends = [
        'department',
        'position'
    ];

    
    /**
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
    

    /**
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\WorkPosition');
    }


    /**
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\Hasone
     */
    public function user()
    {
        return $this->hasOne('App\Models\UserWorker');
    }


    /**
     *  Append ralated attribute.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function getDepartmentAttribute()
    {
        return $this->department()->get('name');    
    }


    /**
     *  Append ralated attribute.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function getPositionAttribute()
    {
        return $this->position()->get('name');    
    }
}
