<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'show_name' => 'string|max:255',
            'about' => 'required|string|max:255',
            'image' => 'required|file',
            'github' => 'url|max:255',
            'city' => 'string|max:255',
            'is_finished' => 'boolean',
            'telegram' => 'string|max:255',
            'phone' => 'string|max:255',
            'birthday' => 'date'
        ];
    }
}
