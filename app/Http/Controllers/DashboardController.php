<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->with(['department', 'roles'])->firstOrfail();
        // if (auth()->user()->diretoria() || auth()->user()->gestor() || auth()->user()->gestorSuporte() || auth()->user()->suporte()) {
        $departments = new Department();
        return view('dashboard.index')->with([
                'departments' => $departments->supportAreas(),
                'user' => $user,
                'users' => User::orderBy('name')->get(),
            ]);
        // } else {
        //     return redirect()->route('home');
        // }
    }

    public function ajuda()
    {
        return view('dashboard.ajuda')->with([
            'menus' => auth()->user()->menus(),
        ]);
    }
}
