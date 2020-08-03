<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Setor;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chartSetores()
    {
        $count = array();
        $setores = Setor::where('area_suporte_id', auth()->user()->areaSuporte())->get();

        foreach ($setores as $setor) {
            $count[$setor->nome] = Chamado::where('setor_id', $setor->id)->count();
        }

        return json_encode($count);
    }

    public function chartServicos()
    {
        $count = array();
        $setores = Setor::where('area_suporte_id', auth()->user()->areaSuporte())->with('servicos')->get();

        foreach ($setores as $setor) {
            foreach ($setor->servicos as $servico) {
                $count[$servico->nome] = Chamado::where('servico_id', $servico->id)->count();
            }
        }

        return json_encode($count);
    }

    public function chartStatus()
    {
        $count = array();
        $statuses = [0, 1, 2, 3];

        // 0 => concluído; 1 => aberto; 2 => andamento; 3 => recusado;
        foreach ($statuses as $status) {
            $count[$status == 0 ? 'Concluído' : ($status == 1 ? 'Aberto' : ($status == 2 ? 'Andamento' : 'Recusado'))] = Chamado::where('status', $status)->where('departamento_id', auth()->user()->areaSuporte())->count();
        }

        return json_encode($count);
    }
}
