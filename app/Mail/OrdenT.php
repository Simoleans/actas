<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdenT extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $url;
     public $orden;
     
    public function __construct($url,$orden)
    {
        $this->url = $url;
        $this->orden = $orden;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ordenT.mail')
                    ->from('no-reply@actas.veanx.cl')
                    ->subject('Firma La Orden De Trabajo');
    }
}
