<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="RegisterRequest",
 *  @OA\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="email",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="type",
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
 *      property="phone",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="birthday",
 *      type="string"
 *  )
 * )
 */
class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:8|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|string|min:8|max:255',
            'github' => 'url|min:8|max:255',
            'city' => 'string|min:8|max:255',
            'phone' => 'string|min:8|max:255',
            'birthday' => 'date'
        ];
    }
}
