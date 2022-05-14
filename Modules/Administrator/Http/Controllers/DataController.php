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
}
