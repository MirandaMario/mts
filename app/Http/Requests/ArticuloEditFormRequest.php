<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticuloEditFormRequest extends Request
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
            'idcategoria'   => 'required',
            'codigo'        => 'required|max:50',
            'nombre'        => 'required|max:500',
            'descripcion'   => 'max:2000',
            'imagen'        => 'mimes:jpeg,bmp,png'
        ];
    }
}
