<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Member;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
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
            'first_name'   => 'sometimes|required|max:50|string',
            'last_name'    => 'sometimes|nullable|max:40:|string',
            'email'        => 'sometimes|required|max:100|email|regex:/^\S*$/u|unique:members,email',
            'member_type'  => Rule::in(Member::MEMBER_TYPES),
            'is_board'     => Rule::in(Member::IS_BOARD),
            'phone_number' => 'sometimes|required|numeric|min:10000000|max:99999999',
            'street_name'  => 'sometimes|nullable|max:50',
            'zip_code'     => 'sometimes|nullable|numeric|min:1000|max:9999',
            'city'         => 'sometimes|nullable|max:30|string',
            'pay_date'     => 'sometimes|nullable|date',
            'amount'       => 'sometimes|numeric'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'   => 'Fornavn er påkrævet',
            'email.required'        => 'Email er påkrævet',
            'email.email'           => 'Email skal være et gyldigt format',
            'email.regex'           => 'Email skal være et gyldigt format',
            'email.unique'          => 'Email addressen er allerede i brug',
            'phone_number.required' => 'Mobilnummer er påkrævet',
            'phone_number.max'      => 'Mobilnummer er for langt',
            'phone_number.min'      => 'Mobilnummer er for kort',
            'member_type.in'        => 'Medlemstypen er ugyldig',
            'zip_code.max'          => 'Postnummeret er ugyldigt',
            'zip_code.min'          => 'Postnummeret er ugyldigt',
            'zip_code.numeric'      => 'Postnummeret skal være et tal',
            'street_name.max'       => 'Vejnavnet er for langt',
            'city.max'              => 'Bynavnet er for langt',
            'pay_date'              => 'Kontingentet er ikke et gyldigt datoformat'
        ];
    }
}
