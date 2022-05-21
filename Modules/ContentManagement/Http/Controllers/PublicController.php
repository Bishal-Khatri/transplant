<?php

namespace Modules\ContentManagement\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\Palika;
use Modules\Administrator\Entities\Municipality;
use Modules\Administrator\Entities\District;
use Modules\Administrator\Entities\Province;

class PublicController extends Controller
{
    use SetResponse;

    public function province()
    {
        $provinces = Province::all();

        return response()->json($this->prepareResponse(false, 'success', compact('provinces'), []));
    }
    public function district(Request $request)
    {
        $districts = District::where('province_id',$request->province_id)->get();

        return response()->json($this->prepareResponse(false, 'success', compact('districts'), []));
    }
    public function municipality(Request $request)
    {
        $municipalities = Municipality::where('district_id',$request->district_id)->get();

        return response()->json($this->prepareResponse(false, 'success', compact('municipalities'), []));
    }
}
