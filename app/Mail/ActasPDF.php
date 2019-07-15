<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActasPDF extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $ruta;
    public $acta;
    public $id_acta;
     
    public function __construct($ruta,$acta,$id_acta)
    {
        $this->ruta = $ruta;
        $this->acta = $acta;
        $this->id_acta = $id_acta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('mail.pdf')
                    ->from('no-reply@actas.veanx.cl')
                    ->subject('Descarga Acta De Asistencia');
    }
}
