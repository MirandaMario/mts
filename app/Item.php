<?php

namespace App;
/* Clase de para organizar las columnas */
class item
{
    private $producto;
    private $cantidad;
	private $precio;
	private $total;

    public function __construct($cantidad = '', $producto = '',$precio = '', $total = '', $descuento = '' )
    {
        $this ->producto = $producto;
        $this ->cantidad = $cantidad;
        $this ->precio = $precio;
        $this ->total = $total;
        $this ->descuento = $descuento;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 60;
        //if ($this -> dollarSign) {
            $leftCols = $leftCols / 4 - $rightCols / 4;
        //}
		$left = str_pad($this ->cantidad , 5) ;
		$left1 = str_pad($this ->producto, 29) ;
		$left2 = str_pad($this ->precio, 11, ' ', STR_PAD_LEFT);
        $right = str_pad($this ->total, 11, ' ', STR_PAD_LEFT);
        $right2 = str_pad($this ->descuento, 56, ' ', STR_PAD_LEFT);

        if ($this->descuento < 0) {
            return "$left$left1$left2$right\n$right2\n";
        } else {
            return "$left$left1$left2$right\n";
        }
    
       
    }
}
