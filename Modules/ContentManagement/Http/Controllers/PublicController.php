<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\Palika;
use Modules\Administrator\Entities\Municipality;
use Modules\Administrator\Entities\District;
use Modules\Administrator\Entities\Province;

class PublicController extends Controller
{
    public function province(){
        $provinces = Province::all();
        return response()->json($provinces);
    }
    public function district(Request $request){
        $districts = District::where('province_id',$request->province_id)->get();
        return response()->json($districts);
    }
    public function municipality(Request $request){
        $municipalities = Municipality::where('district_id',$request->district_id)->get();
        return response()->json($municipalities);
    }
    public function palika(Request $request){
        $palikas = Palika::where('district_id',$request->district_id)->get();
        return response()->json($palikas);
    }
}
