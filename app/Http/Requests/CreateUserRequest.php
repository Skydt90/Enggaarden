<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'username' => ['required','string', '', 'max:20', 'unique:users,username'], //username must not exist in users -> username column in db
            'user_type' => ['required', 'string', 'max:13', Rule::in(User::USER_TYPES)],
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Brugernavn er påkrævet',
            'username.max' => 'Brugernavn kan ikke være længere end 20 tegn',
            'username.unique' => 'Brugernavn er allerede taget',
            'user_type.in' => 'Brugertype er ugyldig',
            'username.min' => 'Brugernavn skal mindst være 3 tegn',
            'password.required' => 'Du skal skrive et kodeord',
            'password.confirmed' => 'Din bekræftelse matcher ikke kodeordet',
            'password.min' => 'Kodeordet skal være mindst 6 tegn langt',
        ];

    }
}
