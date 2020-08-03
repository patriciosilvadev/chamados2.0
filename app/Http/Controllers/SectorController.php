<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function fetch(Department $department)
    {
        return $department->sectors;
    }
}
