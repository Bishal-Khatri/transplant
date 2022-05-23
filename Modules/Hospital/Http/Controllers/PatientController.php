<?php

namespace Modules\Hospital\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientController extends Controller
{
    public function index()
    {
        return view('hospital::patient.index');
    }

    public function create()
    {
        return view('hospital::patient.create');
    }
}
