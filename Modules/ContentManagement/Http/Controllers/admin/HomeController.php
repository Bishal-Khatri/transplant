<?php

namespace Modules\ContentManagement\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('contentmanagement::admin.dashboard');
    }
}
