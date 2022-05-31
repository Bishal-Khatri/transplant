<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\SetResponse;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Enum\HospitalApproveStatus;

class HospitalController extends Controller
{
    use SetResponse;

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

    public function hospitalList($id)
    {
        $hospital = json_encode(Hospital::with([
            'province',
            'district',
            'municipality',
        ])->find($id));
        return view('administrator::pages.hospital-detail',compact('hospital'));
    }

    public function createHospital()
    {
        return view('administrator::pages.hospital-create');
    }

    public function getHospital(Request $request)
    {
        $request->validate([
            'status_type' => 'required|string',
            'status' => 'required',
            'hospital_id' => 'required|integer',
        ]);

        try{
            $hospital = Hospital::findOrFail($request->hospital_id);

            if ($request->status_type == 'accessibility'){
                $hospital->status = $request->status;
            }
            elseif($request->status_type == 'document_verification'){
                $hospital->document_verification = $request->status;
            }
            elseif($request->status_type == 'physical_verification'){
                $hospital->physical_verification = $request->status;
            }

            $hospital->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Status changed successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

    public function changeHospitalStatus(Request $request)
    {
        $request->validate([
            'status_type' => 'required|string',
            'status' => 'required',
            'hospital_id' => 'required|integer',
        ]);

        try{
            $hospital = Hospital::findOrFail($request->hospital_id);

            if ($request->status_type == 'accessibility'){
                $hospital->status = $request->status;
            }
            elseif($request->status_type == 'document_verification'){
                $hospital->document_verification = $request->status;
            }
            elseif($request->status_type == 'physical_verification'){
                $hospital->physical_verification = $request->status;
            }

            $hospital->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Status changed successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

    public function approveHospital(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|integer',
        ]);

        try{
            $hospital = Hospital::findOrFail($request->hospital_id);
            $hospital->approve_status = HospitalApproveStatus::APPROVED;
            $hospital->approved_by = auth()->user()->id;
            $hospital->approved_date = Carbon::now();
            $hospital->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Hospital approved successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

    public function rejectHospital(Request $request)
    {
        $request->validate([
            'reject_message' => 'required',
            'hospital_id' => 'required|integer',
        ]);

        try{
            $hospital = Hospital::findOrFail($request->hospital_id);
            $hospital->approve_status = HospitalApproveStatus::REJECTED;
            $hospital->reject_message = $request->reject_message;
            $hospital->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Hospital rejected successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

}
