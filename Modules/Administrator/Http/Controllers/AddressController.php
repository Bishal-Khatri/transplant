<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\District;
use Modules\Administrator\Entities\Municipality;
use Modules\Administrator\Entities\Palika;
use Modules\Administrator\Entities\Province;

class AddressController extends Controller
{
    use SetResponse;

    public function provinceIndex()
    {
        return view('administrator::pages.province-index');
    }

    public function districtIndex(Request $request)
    {
        $province_id = $request->get('province_id');
        $province = Province::findOrFail($province_id);

        return view('administrator::pages.district-index',compact('province', 'province_id'));

    }

    public function localLevelIndex(Request $request)
    {
        $district_id =$request->get('district_id');
        $district = District::findOrFail($district_id);
        $province = $district->province();

        return view('administrator::pages.local-level-index',compact('district', 'province', 'district_id'));
    }

    // WEB APIS
    // province
    public function province(Request $request)
    {
        $query = Province::query();
        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }

        $provinces = $query->withCount([
            'districts',
        ])->orderBy('id', 'desc')->paginate(10);


        $returnData = $this->prepareResponse(false, 'success.', compact('provinces'), []);
        return response()->json($returnData);
    }

    public function provinceStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $province = Province::findOrFail($request->id);
            } else {
                $province = new Province();
            }

            $province->title = $request->title;
            $province->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function provinceDelete($id)
    {
        try {
            $province = Province::findOrFail($id);
            $province->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // provinceS END

    // District
    public function district(Request $request)
    {
        $query = District::query();
        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }
        $request->province_id && $query = $query->where('province_id',$request->province_id);
        $districts = $query->withCount([
            'municipalities',
            'palikas',
        ])->with('province')->orderBy('id', 'desc')->paginate(10);

        $returnData = $this->prepareResponse(false, 'success.', compact('districts'), []);
        return response()->json($returnData);
    }

    public function districtStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'province_id'=>'required|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $district = District::findOrFail($request->id);
            } else {
                $district = new District();
            }

            $district->title = $request->title;
            $district->province_id=$request->province_id;
            $district->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function districtDelete($id)
    {
        try {
            $district = District::findOrFail($id);
            $district->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // District END

    //Municipality
    public function municipality(Request $request)
    {
        $query = Municipality::query();
        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }
        $request->district_id && $query = $query->where('district_id',$request->district_id);
        $municipalities = $query->with('district')->orderBy('id', 'desc')->paginate(10);
        $returnData = $this->prepareResponse(false, 'success.', compact('municipalities'), []);
        return response()->json($returnData);
    }

    public function municipalityStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'district_id'=>'required|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $municipality = Municipality::findOrFail($request->id);
            } else {
                $municipality = new Municipality();
            }

            $municipality->title = $request->title;
            $municipality->district_id=$request->district_id;
            $municipality->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function municipalityDelete($id)
    {
        try {
            $municipality = Municipality::findOrFail($id);
            $municipality->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // Municipality END

    //Palika
    public function palika(Request $request)
    {
        $query = Palika::query();
        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }
        $request->district_id && $query = $query->where('district_id',$request->district_id);
        $palikas = $query->with('district')->orderBy('id', 'desc')->paginate(10);
        $returnData = $this->prepareResponse(false, 'success.', compact('palikas'), []);
        return response()->json($returnData);
    }

    public function palikaStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'district_id'=>'required|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $palika = Palika::findOrFail($request->id);
            } else {
                $palika = new Palika();
            }

            $palika->title = $request->title;
            $palika->district_id=$request->district_id;
            $palika->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function palikaDelete($id)
    {
        try {
            $palika = Palika::findOrFail($id);
            $palika->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // Palika END
}
