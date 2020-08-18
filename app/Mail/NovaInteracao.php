<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaInteracao extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $chamado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chamado)
    {
        $this->chamado = $chamado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.interacoes.nova')->with(['chamado' => $this->chamado]);
    }
}
