<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Hospital\Entities\Hospital;
class HospitalController extends Controller
{
    public function listHospitals()
    {
        return view('administrator::pages.hospital-index');
    }

    public function hospitals(Request $request)
    {
        $query = Hospital::query();
        if ($request->has('filter_by') AND !blank($request->filter_by)) {
            if($request->filter_by=="HospitalTypes"){
                    $query->where('hospital_type',$request->filter_by_option);
            }else if($request->filter_by=="HospitalVerificationStatus"){
                $query->where('verification_status', $request->filter_by_option);
            }else if($request->filter_by=="TransplantTypes"){
                $query->where('transplant_type', $request->filter_by_option);
            }else if($request->filter_by=="HospitalApproveStatus"){
                $query->where('approve_status',$request->filter_by_option);
            }else if($request->filter_by=="VerificationStatus"){
                $query->where('verification_status',$request->filter_by_option);
            }
            if($request->has('filter')){
                $query->where('hospital_name', 'LIKE', '%'.$request->filter.'%');
            }
        }
        $hospitals = $query->orderBy('id', 'desc')->paginate(10);
        return response()->json($hospitals);
    }
    public function hospitals_view($id){
        $hospital = json_encode(Hospital::with([
            'province',
            'district',
            'municipality',
        ])->find($id));
        return view('administrator::pages.hospital-detail',compact('hospital'));
    }
    // // delete hospital
    // public function delete($id)
    // {
    //     try {
    //         $hospital = Hospital::find($id);
    //         $hospital->delete();
    //         $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
    //         return response()->json($returnData,200);
    //     } catch (\Exception $e) {
    //         $message = $e->getMessage();
    //         $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
    //         return response()->json($returnData,500);
    //     }
    // }


}
