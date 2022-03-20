<?php

namespace App;
/* Clase de para organizar las columnas */
class item2
{
    private $fecha;
    private $numero;
	private $total;

    public function __construct($fecha = '', $numero = '',$total = '')
    {
        $this ->fecha = $fecha;
        $this ->numero = $numero;
        $this ->total = $total;      
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 60;
        
            //$leftCols = $leftCols / 4 - $rightCols / 4;
        
		$left = str_pad($this ->fecha , 20) ;
		$left1 = str_pad($this ->numero, 10) ;
        $right = str_pad($this ->total, 25, ' ', STR_PAD_LEFT);
        return "$left$left1$right\n";
    }
}
