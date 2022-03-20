<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionDeRecuperacionPasswordMMSOFT extends Mailable
{
    use Queueable, SerializesModels;

    public $p; 

   
    public function __construct($p)
    {
        $this->p = $p; 

    }

    public function build()
    {   
        return $this->view('mail.notificacion_password');
    }
}
