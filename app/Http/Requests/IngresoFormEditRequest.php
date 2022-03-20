<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IngresoFormEditRequest extends Request
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
            'idproveedor' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:12',
            'num_comprobante' => 'required',
            //'idarticulo' => 'required',
            //'cantidad' => 'required',
            //'precio_compra' => 'required'
            //'precio_venta' => 'required'
        ];
    }
}
