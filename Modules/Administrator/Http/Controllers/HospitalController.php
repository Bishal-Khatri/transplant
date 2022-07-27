<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\SendEmail;
use App\Traits\SetResponse;
use App\Traits\UserTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use \Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Entities\License;
use Modules\Hospital\Enum\HospitalApproveStatus;

class HospitalController extends Controller
{
    use SetResponse, UserTrait, SendEmail;

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
        try {
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
        } catch (ModelNotFoundException $exception){
            throw new ModelNotFoundException('Hospital Not Found');
        } catch (\Exception $exception){
            throw new \Exception('General error');
        }
    }

    public function hospitals(Request $request)
    {
        $query = Hospital::query();
        $query->with('approvedByUser');
         if($request->has('q')){
             $query->where('hospital_name', 'LIKE', '%'.$request->q.'%');
         }
        if($request->has('hospital_type') && !blank($request->hospital_type)){
            $query->where('hospital_type', $request->hospital_type);
        }
        // transplant_type
        if($request->has('transplant_type') && !blank($request->transplant_type)){
            $query->where('transplant_type', $request->transplant_type);
        }
        // approval_status
        if($request->has('approval_status') && !blank($request->approval_status)){
            $query->where('approve_status', $request->approval_status);
        }
        // document_verification
        if($request->has('document_verification') && !blank($request->document_verification)){
            $query->where('document_verification', $request->document_verification);
        }
        // physical_verification
        if($request->has('physical_verification') && !blank($request->physical_verification)){
            $query->where('physical_verification', $request->physical_verification);
        }

        // if ($request->has('filters')){
        //     $filters = json_decode($request->filters);
        //         if (!blank($filters)){
        //             foreach ($filters as $filter){
        //                 if(!blank($filter)){
        //                     if ($filter->filter_by=="HospitalTypes"){
        //                         $query->where('hospital_type',$filter->filter_by_option);
        //                     }else if($filter->filter_by=="HospitalVerificationStatus"){
        //                         $query->where('verification_status', $filter->filter_by_option);
        //                     }else if($filter->filter_by=="TransplantTypes"){
        //                         $query->where('transplant_type', $filter->filter_by_option);
        //                     }else if($filter->filter_by=="HospitalApproveStatus"){
        //                         $query->where('approve_status',$filter->filter_by_option);
        //                     }else if($filter->filter_by=="VerificationStatus"){
        //                         $query->where('verification_status',$filter->filter_by_option);
        //                     }
        //                 }
        //             }
        //     }
        // }
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

        \DB::beginTransaction();
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

            // send email
            $hospital_user = $hospital->user;
            $data = [
                'name' => $hospital_user->name,
                'account_link' => 'https://www.transplant.iionstech.com/hospital',
                'email' => $hospital_user->email,
                'password' => $this->defaultPasswordText()
            ];
            $this->basic_email($hospital_user,$data);

            \DB::commit();
            $returnData = $this->prepareResponse(false, 'Success <br> Hospital approved successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            \DB::rollback();
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

//            $hospital_user = $hospital->user;
//            $data = [
//                'name' => $hospital_user->name,
//                'account_link' => 'https://www.transplant.iionstech.com/hospital',
//                'email' => $hospital_user->email,
//                'password' => $this->defaultPasswordText()
//            ];
//            $this->basic_email($hospital_user,$data);

            $returnData = $this->prepareResponse(false, 'Success <br> Hospital rejected successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }
    public function delete($id){
        try{
            $hospital = Hospital::findOrFail($id);
            $hospital->delete();
            $returnData = $this->prepareResponse(false, 'Success <br> Hospital deleted successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(false, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

}
