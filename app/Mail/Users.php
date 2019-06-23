<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Users extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $url;
     public $empresa;
     
    public function __construct($url,$empresa)
    {
        $this->url = $url;
        $this->empresa = $empresa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('empresas.mail')
                    ->from('no-reply@actas.veanx.cl')
                    ->subject('¡Forma Parte De Esta Empresa!');
    }
}
