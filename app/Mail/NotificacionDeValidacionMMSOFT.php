<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionDeValidacionMMSOFT extends Mailable
{
    use Queueable, SerializesModels;

    public $persona; 

   
    public function __construct($persona)
    {
        $this->persona = $persona; 

    }

    public function build()
    {   
        return $this->view('mail.notificacion_validacion');
    }
}
