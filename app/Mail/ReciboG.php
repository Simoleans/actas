<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReciboG extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $url;
     public $guia;
     
    public function __construct($url,$guia)
    {
        $this->url = $url;
        $this->guia = $guia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('reciboG.mail')
                    ->from('no-reply@actas.veanx.cl')
                    ->subject('Firma El Recibo De Pago');
    }
}
