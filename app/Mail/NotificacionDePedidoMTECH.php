<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionDePedidoMTECH extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido; 
    public $detalle; 
   
    public function __construct($pedido,  $detalle)
    {
        $this->pedido = $pedido; 
        $this->detalle = $detalle;    
    }

    public function build()
    {   
        return $this->view('mail.notificacion_pedido_mtech');
    }
}
