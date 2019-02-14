<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\City;

class CitiesController extends Controller
{
    public function listCountries() {
        return response()->json(City::select('id', 'country')->get()->toArray());
    }
}