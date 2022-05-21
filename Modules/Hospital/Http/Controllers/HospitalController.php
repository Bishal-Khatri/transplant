<?php

namespace Modules\Hospital\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Enum\HospitalApproveStatus;
use Modules\Hospital\Enum\HospitalVerificationStatus;

class HospitalController extends Controller
{
    use SetResponse;

    public function patients()
    {
        return view('hospital::patient.index');
    }

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
            'hospital_name' => 'required',
            'province' => 'required',
            'municipality' => 'required',
            'palika' => 'required',
            'transplant_type' => 'required',
            'hospital_type' => 'required',
            'application_letter' => 'required',
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

        $hospital->approve_status = HospitalApproveStatus::UNAPPROVED;
        $hospital->verification_status = HospitalVerificationStatus::NONE;
        $hospital->status = 0;

        $hospital->save();

        //save data
        $returnData = $this->prepareResponse(false, 'success', [], []);
        return response()->json($returnData);
    }
}
