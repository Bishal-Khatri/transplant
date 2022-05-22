<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HospitalController extends Controller
{
    public function listHospitals()
    {
        return view('administrator::pages.hospital-index');
    }
}
