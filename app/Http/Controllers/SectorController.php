<?php

namespace App\Http\Controllers;

use App\Sector;
use App\Department;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            $sectors = new Sector;
            return $sectors->search(request()->all());
        }
    }
}
