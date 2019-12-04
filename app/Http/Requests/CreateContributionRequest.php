<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContributionRequest extends FormRequest
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
            'activity_type' => 'required|exists:activity_types,activity_type',
            'amount' => 'required|numeric|min:1',
            'pay_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'activity_type.required' => 'Du skal vælge en aktivitet. Hvis du ikke kan finde den rigtige så opret en ny, og start forfra',
            'amount.min' => 'Beløbet må ikke være mindre end 1 krone',
            'pay_date.required' => 'Du skal vælge en betalingsdato'
        ];
    }
}
