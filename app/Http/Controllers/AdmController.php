<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmController extends Controller
{
    public function home()
    {
        return view('app.adm.home');
    }
}
