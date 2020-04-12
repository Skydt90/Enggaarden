<?php

namespace App\Http\Requests;

use App\Models\Email;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmailRequest extends FormRequest
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
            'receiver' => 'sometimes|required|email',
            'group'    => 'sometimes|required|' . Rule::in(Email::MAIL_GROUPS),
            'subject'  => 'required|string|max:30|min:2',
            'message'  => 'required|string|min:10',
            'file'     => 'sometimes|file|mimes:pdf,txt,text,docx,xlsx,csv|max:250', 
        ];
    }

    public function messages()
    {
        return [
            'receiver.required' => 'Modtager feltet er påkrævet',
            'receiver.email'    => 'Modtager feltet har et ugyldigt email format',
            'group.required'    => 'Modtager feltet er påkrævet',
            'group.in'          => 'Modtager gruppen er ugyldig',
            'subject.required'  => 'Emne er påkrævet',
            'subject.max'       => 'Emnet må ikke overskride 30 bogstaver',
            'subject.min'       => 'Emnet skal være mindst 2 bogstaver langt',
            'message.required'  => 'Besked er påkrævet',
            'message.min'       => 'Din besked kan ikke være kortere end 10 bogstaver',
            'file.file'         => 'Filen skal være en fil',
            'file.mimes'        => 'Filtypen skal være pdf, txt eller text',
            'file.max'          => 'Filen må max være på 0,25 megabyte'
        ];
    }
}
