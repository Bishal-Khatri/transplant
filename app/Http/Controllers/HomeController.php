<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\SetResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SetResponse;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getUserByEmail(Request $request)
    {
        $request->validate([
            'user_email' => 'required'
        ]);
        try {
            $user = User::where('email', $request->user_email)->firstOrFail();
            return  response()->json($this->prepareResponse(false, 'success', compact('user'), []));
        } catch (\Exception $exception){
            return response()->json($this->prepareResponse(true, $exception->getMessage(), [], []), 404);
        }
    }
}
