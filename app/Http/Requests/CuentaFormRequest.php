<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CuentaFormRequest extends Request
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
           
            'numeroCuenta'  => 'required|max:50|unique:cuentas',
            'nombreCuenta'  => 'required|max:300',
          
        ];
    }
}
