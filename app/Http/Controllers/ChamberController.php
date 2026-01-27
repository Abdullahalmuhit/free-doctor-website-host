<?php

namespace App\Http\Controllers;

use App\Models\Chamber;

class ChamberController extends Controller
{
    public function index()
    {
        $chambers = Chamber::active()->get();

        return view('frontend.chambers', compact('chambers'));
    }
}
