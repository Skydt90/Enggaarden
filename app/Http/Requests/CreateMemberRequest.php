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
            'email' => 'required|max:100|email|unique:members,email',
            'phone_number' => 'required|numeric|min:10000000|max:99999999',
            'member_type' => Rule::in(Member::MEMBER_TYPES)
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Fornavn er påkrævet',
            'email.required' => 'Email er påkrævet',
            'email.unique' => 'Email er allerede i brug',
            'phone_number.required' => 'Mobilnummer er påkrævet',
            'phone_number.max' => 'Mobilnummer er for langt',
            'phone_number.min' => 'Mobilnummer er for kort',
            'member_type.in' => 'Medlemstypen er ugyldig'
        ];
    }
}
