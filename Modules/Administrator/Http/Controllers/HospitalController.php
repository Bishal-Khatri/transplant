<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\SetResponse;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use \Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Entities\License;
use Modules\Hospital\Enum\HospitalApproveStatus;

class HospitalController extends Controller
{
    use SetResponse;

    public function listHospitals()
    {
        return view('administrator::pages.hospital-index');
    }

    public function displayHospital($hospital_id)
    {
        return view('administrator::pages.hospital-detail', compact('hospital_id'));
    }

    public function getHospitalDetails($hospital_id)
    {
        try{
            $hospital = Hospital::with([
                'user',
                'license', 'license.issuedByUser',
                'province',
                'district',
                'municipality',
                'approvedByUser',
            ])->findOrFail($hospital_id);

            $license_expiry_status = [];
            if (!blank($hospital->license)){
                $license_expiry_status = $hospital->license->licenseStatus();
            }

            $returnData = $this->prepareResponse(false, 'success', compact('hospital', 'license_expiry_status'), []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
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

    public function createHospital()
    {
        return view('administrator::pages.hospital-create');
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

            if (blank($hospital->active_license_id)){
                $request->validate([
                    'expiry_date' => 'required',
                ]);
                if (isset($request->expiry_date) AND !blank($request->expiry_date)){
                    $license_data = [
                        'license_number' => $hospital->id . time(),
                        'issue_date' => Carbon::today(),
                        'expiry_date' => $request->expiry_date,
                        'unique_key' => Str::random('15'),
                        'issued_by' => auth()->user()->id
                    ];
                    $license = $hospital->licenseMorph()->create($license_data);

                    $hospital->active_license_id = $license->id;
                    $hospital->save();
                }
            }

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
