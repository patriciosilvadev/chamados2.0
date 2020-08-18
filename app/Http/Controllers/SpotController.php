<?php

namespace App\Http\Controllers;

use App\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return Spot::where('environment_id', request('environment'))->get();
        }
    }
}
