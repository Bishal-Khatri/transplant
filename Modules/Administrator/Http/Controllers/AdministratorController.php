<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdministratorController extends Controller
{
    public function index()
    {
        return view('administrator::index');
    }
}
