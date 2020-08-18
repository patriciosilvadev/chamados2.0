<?php

namespace App\Http\Controllers;

use App\Environment;
use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    /**
     *
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return Environment::get();
        }
    }
}
