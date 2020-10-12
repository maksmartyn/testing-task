<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="UpdateUserRequest",
 *  @OA\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="image",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="about",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="github",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="city",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="is_finished",
 *      type="boolean"
 *  ),
 *  @OA\Property(
 *      property="phone",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="birthday",
 *      type="string"
 *  )
 * )
 */
class UpdateUserRequest extends FormRequest
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
            'name' => 'string|max:255',
            'about' => 'string|max:255',
            'image' => 'string',
            'github' => 'url|max:255',
            'city' => 'string|max:255',
            'is_finished' => 'boolean',
            'phone' => 'string|max:255',
            'birthday' => 'date'
        ];
    }
}
