<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
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
            'name' => 'required|string',
            'rows' => 'required|integer',
            'row_length' => 'required|integer',
            'userPlaces.*.place_row' => 'required|integer',
            'userPlaces.*.place_number' => 'required|integer',
            'userPlaces.*.hall_id' => 'exists:halls,id',
            'userPlaces.*.place_type_id' => 'exists:place_types,id',
        ];
    }
}