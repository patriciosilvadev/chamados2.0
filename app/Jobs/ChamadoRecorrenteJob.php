<?php

namespace App\Jobs;

use App\Chamado;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ChamadoRecorrenteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timeInterval = [
        'daily' => ['addDays', 1],
        'weekly' => ['addWeeks', 1],
        'biweekly' => ['addWeeks', 2],
        'monthly' => ['addMonths', 1],
        'bimonthly' => ['addMonths', 2],
        'quarterly' => ['addMonths', 3],
        'semiannual' => ['addMonths', 6],
        'yearly' => ['addYears', 1],
        'biennial' => ['addYears', 2],
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $today = Carbon::now();
        $chamados = Chamado::whereNotNull('recorrente')->get();

        foreach ($chamados as $chamado) {
            $carbonMethod = $this->timeInterval[$chamado->recorrente][0];
            $dataPrevista =  new Carbon($chamado->data_prevista);

            if ($dataPrevista->$carbonMethod($this->timeInterval[$chamado->recorrente][1])->format('Y-m-d') == $today->format('Y-m-d')) {
                Chamado::create([
                    'departamento_id' => $chamado->departamento_id,
                    'usuario_id' => $chamado->usuario_id,
                    'local_id' => $chamado->local_id,
                    'ambiente_id' => $chamado->ambiente_id,
                    'setor_id' => $chamado->setor_id,
                    'servico_id' => $chamado->servico_id,
                    'descricao' => $chamado->descricao,
                    'data_prevista' => $today,
                    'data_desejada' => $chamado->data_desejada,
                    'status' => 1,
                    'anexo' => $chamado->anexo,
                    'recorrente' => $chamado->recorrente
                ]);

                $chamado->update(['recorrente' => null]);
            }
        }
    }
}
