<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
