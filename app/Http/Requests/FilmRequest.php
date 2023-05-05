<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
        if(request()->isMethod('post')){
            return [
                'name' => 'required|string',
                'minutes' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ];
        } else {
            return [
                'name' => 'required|string',
                'minutes' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ];
        }
    }
}
