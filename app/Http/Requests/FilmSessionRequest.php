<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmSessionRequest extends FormRequest
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
            '*.start_date_time' => 'required|date',
            '*.session_minutes' => 'required|integer',
            '*.film_id' => 'exists:films,id',
            '*.hall_id' => 'exists:halls,id',
        ];
    }
}
