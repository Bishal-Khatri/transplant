<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\Religion;
use Modules\Administrator\Entities\EthnicGroup;
use Modules\Administrator\Entities\Disease;
use Modules\Administrator\Entities\EducationLevel;
use Modules\Administrator\Entities\Occupation;
use Modules\Administrator\Entities\Province;
use Modules\Administrator\Entities\District;
use Modules\Administrator\Entities\Municipality;

class DataController extends Controller
{
    use SetResponse;

    public function religionIndex()
    {
        return view('administrator::pages.religion-index');
    }

    public function ethnicGroupIndex()
    {
        return view('administrator::pages.ethnic-groups-index');
    }

    public function diseaseIndex()
    {
        return view('administrator::pages.disease-index');
    }

    public function educationLevelIndex()
    {
        return view('administrator::pages.education-level-index');
    }

    public function occupationIndex()
    {
        return view('administrator::pages.occupation-index');
    }
    public function provinceIndex(){
        return view('administrator::pages.province-index');
    }
    public function districtIndex(Request $request){
        $province_id =$request->get('province_id');
        return view('administrator::pages.district-index',[
            'province_id'=>$province_id
        ]);
    }
    public function localLevelIndex(Request $request){
        $district_id =$request->get('district_id');
        return view('administrator::pages.local-level-index',[
            'district_id'=>$district_id
        ]);
    }

    // WEB APIS

    // RELIGIONS
    public function religions(Request $request)
    {
        $query = Religion::query();

        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }

        $religions = $query->orderBy('id', 'desc')->paginate(10);

        $returnData = $this->prepareResponse(false, 'success.', compact('religions'), []);
        return response()->json($returnData);
    }

    public function religionsStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $religion = Religion::findOrFail($request->id);
            } else {
                $religion = new Religion();
            }

            $religion->title = $request->title;
            $religion->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function religionsDelete($id)
    {
        try {
            $religion = Religion::findOrFail($id);
            $religion->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // RELIGIONS END

    // Ethnic Group ethnic_groups
    public function ethnicGroups(Request $request)
    {
        $query = EthnicGroup::query();

        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }

        $ethnicGroups = $query->orderBy('id', 'desc')->paginate(10);

        $returnData = $this->prepareResponse(false, 'success.', compact('ethnicGroups'), []);
        return response()->json($returnData);
    }

    public function ethnicGroupStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $ethnicGroup = EthnicGroup::findOrFail($request->id);
            } else {
                $ethnicGroup = new EthnicGroup();
            }

            $ethnicGroup->title = $request->title;
            $ethnicGroup->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function ethnicGroupDelete($id)
    {
        try {
            $ethnicGroup = EthnicGroup::findOrFail($id);
            $ethnicGroup->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    } 
    // End Ethnic Group

    // Diseases
    public function diseases(Request $request)
    {
        $query = Disease::query();

        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }

        $diseases = $query->orderBy('id', 'desc')->paginate(10);

        $returnData = $this->prepareResponse(false, 'success.', compact('diseases'), []);
        return response()->json($returnData);
    }

    public function diseaseStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $disease = Disease::findOrFail($request->id);
            } else {
                $disease = new Disease();
            }

            $disease->title = $request->title;
            $disease->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function diseaseDelete($id)
    {
        try {
            $disease = Disease::findOrFail($id);
            $disease->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // Diseases END

     //Education Level
     public function educationLevels(Request $request)
     {
         $query = EducationLevel::query();
 
         if ($request->has('filter') AND !blank($request->filter)) {
             $query->where('title', 'LIKE', '%'.$request->filter.'%');
         }
 
         $educationLevels = $query->orderBy('id', 'desc')->paginate(10);
 
         $returnData = $this->prepareResponse(false, 'success.', compact('educationLevels'), []);
         return response()->json($returnData);
     }
 
     public function educationLevelStore(Request $request)
     {
         $request->validate([
             'id' => 'nullable|integer',
             'title' => 'required|max:255',
         ]);
 
         try {
             if ($request->id) {
                 $educationLevel = EducationLevel::findOrFail($request->id);
             } else {
                 $educationLevel = new EducationLevel();
             }
 
             $educationLevel->title = $request->title;
             $educationLevel->save();
 
             $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
             return response()->json($returnData, 200);
         }catch (\Exception $exception){
             $message = $exception->getMessage();
             $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
             return response()->json($returnData, 500);
         }
 
     }
 
     public function educationLevelDelete($id)
     {
         try {
             $educationLevel = EducationLevel::findOrFail($id);
             $educationLevel->delete();
 
             $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
             return response()->json($returnData, 200);
         } catch (\Exception $exception) {
             $message = $exception->getMessage();
             $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
             return response()->json($returnData, 500);
         }
     } 
     // End Education Level

    // Occupation
    public function occupations(Request $request)
    {
        $query = Occupation::query();

        if ($request->has('filter') AND !blank($request->filter)) {
            $query->where('title', 'LIKE', '%'.$request->filter.'%');
        }

        $occupations = $query->orderBy('id', 'desc')->paginate(10);

        $returnData = $this->prepareResponse(false, 'success.', compact('occupations'), []);
        return response()->json($returnData);
    }

    public function occupationStore(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|max:255',
        ]);

        try {
            if ($request->id) {
                $occupation = Occupation::findOrFail($request->id);
            } else {
                $occupation = new Occupation();
            }

            $occupation->title = $request->title;
            $occupation->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Record created successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }

    public function occupationDelete($id)
    {
        try {
            $occupation = Occupation::findOrFail($id);
            $occupation->delete();
            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    // Occupation END

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
}
