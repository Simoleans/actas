<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActasMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id;
    public $guia;
    public $id_acta;
     
    public function __construct($id,$guia,$id_acta)
    {
        $this->id = $id;
        $this->guia = $guia;
        $this->id_acta = $id_acta;
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
