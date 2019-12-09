<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMemberRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:members,email|regex:/^\S*$/u',
            'phone_number' => 'required|numeric|min:10000000|max:99999999',
            'member_type' => Rule::in(Member::MEMBER_TYPES),
            'street_name' => 'max:50',
            'zip_code' => 'max:4',
            'city' => 'max:30'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Fornavn er påkrævet',
            'email.required' => 'Email er påkrævet',
            'email.unique' => 'Email er allerede i brug',
            'email.email' => 'Email skal være et gyldigt format',
            'email.regex' => 'Email skal være et gyldigt format',
            'phone_number.required' => 'Mobilnummer er påkrævet',
            'phone_number.max' => 'Mobilnummer er for langt',
            'phone_number.min' => 'Mobilnummer er for kort',
            'member_type.in' => 'Medlemstypen er ugyldig',
            'zip_code.max' => 'Postnummeret er ugyldigt',
            'street_name.max' => 'Vejnavnet er for langt',
            'city.max' => 'Bynavnet er for langt'
        ];
    }
}
