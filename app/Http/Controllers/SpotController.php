<?php

namespace App\Http\Controllers;

use App\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function fetch($environment)
    {
        return Spot::where('environment_id', $environment)->get();
    }
}
