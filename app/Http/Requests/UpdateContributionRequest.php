<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContributionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'activity_type' => 'sometimes|required|exists:activity_types,activity_type|not_in:["Gammel data"]',
            'amount' => 'sometimes|required|numeric|min:1',
            'pay_date' => 'sometimes|required'
        ];
    }

    public function messages()
    {
        return [
            'activity_type.required' => 'Du skal vælge en aktivitet. Hvis du ikke kan finde den rigtige så opret en ny, og start forfra',
            'activity_type.not_in' => 'Du kan ikke vælge gammel data, da det kun bruges til forældet data',
            'activity_type.exists' => 'Din hacker ;)',
            'amount.required' => 'Du skal vælge et beløb',
            'amount.min' => 'Beløbet må ikke være mindre end 1 krone',
            'pay_date.required' => 'Du skal vælge en betalingsdato',
        ];
    }
}
