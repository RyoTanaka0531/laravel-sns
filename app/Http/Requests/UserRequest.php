<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //
            'name' => 'required|min:3|max:16',
            'image' => 'image|file',
            'sex' => 'nullable',
            'age' => 'nullable|integer|numeric|lte:100',
            'prefecture_id' => 'nullable',
            'genre_id' => 'nullable',
        ];
    }
}
