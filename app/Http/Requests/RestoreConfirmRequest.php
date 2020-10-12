<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="RestoreConfirmRequest",
 *  @OA\Property(
 *      property="token",
 *      description="Access token",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="password",
 *      description="New password",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="password_confirmation",
 *      description="Confirm new password",
 *      type="string"
 *  )
 * )
 */
class RestoreConfirmRequest extends FormRequest
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
            'token' => 'string|regex:%d-%s',
            'password' => 'string|min:8|max:255',
            'password_confirmation' => 'string|min:8|max:255|confirmed:password'
        ];
    }
}
