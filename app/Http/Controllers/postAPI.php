<?php

namespace App\Http\Controllers;

use App\Models\leads;
use Illuminate\Http\Request;

class postAPI extends Controller
{
    //
    function getMethod()
    {
        return leads::all();
    }
}
