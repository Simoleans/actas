<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Actas extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $id;
     public $guia;
     
    public function __construct($id,$guia)
    {
        $this->id = $id;
        $this->guia = $guia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('mail.actas')
                    ->from('no-reply@actas.veanx.cl')
                    ->subject('Firma El Acta De Asistencia');
    }
}
