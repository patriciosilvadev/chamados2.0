<?php

namespace App\Mail;

use App\Support;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $support;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Support $support)
    {
        $this->support = $support;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.supports.updated')
            ->with(['support' => $this->support]);
    }
}
