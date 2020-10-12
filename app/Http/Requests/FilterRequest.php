<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="FilterRequest",
 *  @OA\Property(
 *      property="query",
 *      description="Find by user name",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="department_id",
 *      description="Find by department id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="position_id",
 *      description="Find by position id",
 *      type="integer"
 *  )
 * )
 */
class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => 'string',
            'department_id' => 'integer',
            'position_id' => 'integer'
        ];
    }
}
