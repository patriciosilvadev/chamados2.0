<?php

namespace App\Http\Controllers;

use App\User;
use App\Departamento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('cod_usuario', auth()->user()->cod_usuario)->with(['departamentos', 'funcoes'])->firstOrfail();
        if (auth()->user()->diretoria() || auth()->user()->gestor() || auth()->user()->gestorSuporte() || auth()->user()->suporte()) {
            return view('dashboard.index')->with([
                'menus' => auth()->user()->menus(),
                'departamentos' => Departamento::areasSuporte(),
                'user' => $user,
                'usuarios' => User::orderBy('nome')->where('status', 1)->get(),
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function ajuda()
    {
        return view('dashboard.ajuda')->with([
            'menus' => auth()->user()->menus(),
        ]);
    }
}
