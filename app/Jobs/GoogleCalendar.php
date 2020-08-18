<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\GoogleCalendar\Event;

class GoogleCalendar implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chamado;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($chamado)
    {
        $this->chamado = $chamado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = new Event;
        $event->name = "Ordem de serviço {$this->chamado->id}";
        $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->chamado->data_prevista);
        $event->endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->chamado->data_prevista)->addHour();

        foreach ($this->chamado->departamento->usuarios as $usuario) {
            $event->addAttendee(['email' => $usuario->email]);
        }

        try {
            $event->save();
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
