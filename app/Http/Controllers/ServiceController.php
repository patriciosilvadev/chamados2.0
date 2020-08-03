<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function fetch($sector)
    {
        return Service::where('sector_id', $sector)->get();
    }
}
