<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivityTypeRequest extends FormRequest
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
            'activity_type' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'activity_type.required' => 'Du skal skrive et aktivitets navn',
            'activity_type.min' => 'Aktivitetsnavnet kan ikke være mindre end 3 bogstaver'
        ];
    }
}
