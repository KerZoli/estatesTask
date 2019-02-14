<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Developer;

class DevelopersController extends Controller
{
    public function index() {
        return response()->json(Developer::select('id', 'name')->get()->toArray());
    }
}