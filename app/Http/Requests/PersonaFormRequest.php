<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonaFormRequest extends Request
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
            'nombre'    => 'required|max:100|min:4',
            'direccion' => 'max:200|required',
            'tel'       => 'max:8|min:8|required',
            'email'     => 'max:50|required|unique:persona', 
            'password'  => 'max:50|required|confirmed'  
        ];
    }
}
