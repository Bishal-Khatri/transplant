<?php

namespace Modules\Hospital\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HospitalController extends Controller
{
    public function patients()
    {
        return view('hospital::patient.index');
    }

    public function profile()
    {
        return view('hospital::profile.index');
    }

    public function index()
    {
        return view('hospital::index');
    }
}
