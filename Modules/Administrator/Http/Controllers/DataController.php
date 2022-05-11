<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\Religion;

class DataController extends Controller
{
    use SetResponse;

    public function religionIndex()
    {
        return view('administrator::pages.religion-index');
    }

    public function ethnicGroupIndex()
    {

    }

    public function diseaseIndex()
    {

    }

    public function educationLevelIndex()
    {

    }

    public function occupationIndex()
    {

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


}
