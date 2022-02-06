<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePostRequest
 * @package App\Http\Requests
 *
 */
class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:5'],
        ];
    }
}
