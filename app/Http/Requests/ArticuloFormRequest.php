<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticuloFormRequest extends Request
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
            'idModelo'       => 'required',
            'codigo'        => 'required|max:50|unique:articulo',
            'nombre'        => 'required|max:500',
           
            'descripcion'   => 'max:512',
            'imagen'        => 'mimes:jpeg,bmp,png',
            'precio'       => 'required',
            'costoProducto'       => 'required'
        ];
    }
}
