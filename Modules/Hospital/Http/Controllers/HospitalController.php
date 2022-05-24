<?php

namespace Modules\Hospital\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Entities\Patient;
use Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Enum\HospitalApproveStatus;
use Modules\Hospital\Enum\HospitalVerificationStatus;

class HospitalController extends Controller
{
    use SetResponse;

    public function profile()
    {
        return view('hospital::profile.index');
    }

    public function index()
    {
        return view('hospital::index');
    }

    public function getRegisterHospital()
    {
        return view('contentmanagement::theme.Stack.pages.register-hospital');
    }

    public function registerHospital(Request $request)
    {
        $request->validate([
            'hospital_name' => 'required|string|max:255',
            'province' => 'required|exists:provinces,id',
            'district' => 'required|exists:districts,id',
            'municipality' => 'required|exists:municipalities,id',
            'palika' => 'required:string|max:255',
            'transplant_type' => 'required',
            'hospital_type' => 'required',
            'application_letter' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'human_resource' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'tools_list' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'administrative_document' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'sanchalan_swikriti' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'renewal_letter' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'pan' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'tax_clearance' => 'required|mimes:png,jpeg,svg,jpg,pdf',
            'agree'=>'required',
        ], [
            'agree.required' => 'You must agree to the terms and conditions.'
        ]);


        $hospital = new Hospital();
        $hospital->hospital_name = $request->hospital_name;
        $hospital->province_id = $request->province;
        $hospital->district_id = $request->district;
        $hospital->municipality_id = $request->municipality;
        $hospital->palika_name = $request->palika;
        $hospital->transplant_type = $request->transplant_type;
        $hospital->hospital_type = $request->hospital_type;

        if ($request->hasFile('application_letter')){
            $application_letter_path = $request->file('application_letter')->store('hospital_files', 'public');
            $hospital->application_letter = $application_letter_path;
        }
        if ($request->hasFile('human_resource')){
            $human_resource_path = $request->file('human_resource')->store('hospital_files', 'public');
            $hospital->human_resource = $human_resource_path;
        }
        if ($request->hasFile('tools_list')){
            $tools_list_path = $request->file('tools_list')->store('hospital_files', 'public');
            $hospital->tools_list = $tools_list_path;
        }
        if ($request->hasFile('administrative_document')){
            $administrative_document_path = $request->file('administrative_document')->store('hospital_files', 'public');
            $hospital->administrative_document = $administrative_document_path;
        }
        if ($request->hasFile('sanchalan_swikriti')){
            $sanchalan_swikriti_path = $request->file('sanchalan_swikriti')->store('hospital_files', 'public');
            $hospital->sanchalan_swikriti = $sanchalan_swikriti_path;
        }
        if ($request->hasFile('renewal_letter')){
            $renewal_letter_path = $request->file('renewal_letter')->store('hospital_files', 'public');
            $hospital->renewal_letter = $renewal_letter_path;
        }
        if ($request->hasFile('pan')){
            $pan_path = $request->file('pan')->store('hospital_files', 'public');
            $hospital->pan = $pan_path;
        }
        if ($request->hasFile('tax_clearance')){
            $tax_clearance_path = $request->file('tax_clearance')->store('hospital_files', 'public');
            $hospital->tax_clearance = $tax_clearance_path;
        }


        $hospital->approve_status = HospitalApproveStatus::UNAPPROVED;
        $hospital->verification_status = HospitalVerificationStatus::NONE;
        $hospital->status = 0;

        $hospital->save();

        //save data
        $returnData = $this->prepareResponse(false, 'success', [], []);
        return response()->json($returnData);
    }

}
