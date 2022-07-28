<?php

namespace Modules\Hospital\Http\Controllers;

use App\Enum\UserType;
use App\Models\User;
use App\Traits\SetResponse;
use App\Traits\UserTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Entities\Patient;
use Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Enum\HospitalApproveStatus;
use Modules\Hospital\Enum\HospitalDocumentVerification;
use Modules\Hospital\Enum\HospitalPlysicalVerification;
use Modules\Hospital\Entities\License;
use Spatie\Activitylog\Models\Activity;
use Auth;
class HospitalController extends Controller
{
    use SetResponse, UserTrait;

    public function profile()
    {
        $hospital_id = auth()->user()->hospital_id;
        $hospital = json_encode(Hospital::with([
            'province',
            'district',
            'municipality',
        ])->find($hospital_id));
        $licenses= License::with('issuedByUser')->where('licenseable_id',$hospital_id)->get();
        return view('hospital::profile.index',compact('hospital','licenses'));
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
            'ward' => 'required|max:255',
            'transplant_type' => 'required',
            'hospital_type' => 'required',
            'transplant_type' => 'required',
            'application_letter' => 'nullable|mimes:png,jpeg,svg,jpg',
            'human_resource' => 'nullable|mimes:png,jpeg,svg,jpg',
            'tools_list' => 'nullable|mimes:png,jpeg,svg,jpg',
            'administrative_document' => 'nullable|mimes:png,jpeg,svg,jpg',
            'sanchalan_swikriti' => 'nullable|mimes:png,jpeg,svg,jpg',
            'renewal_letter' => 'nullable|mimes:png,jpeg,svg,jpg',
            'pan' => 'nullable|mimes:png,jpeg,svg,jpg,pdf',
            'tax_clearance' => 'nullable|mimes:png,jpeg,svg,jpg',
            'infrastructural_document' => 'nullable|mimes:png,jpeg,svg,jpg',
            'agree'=>'required',
            'full_name'=>'required',
            'email'=>'required|email',
        ], [
            'agree.required' => 'You must agree to the terms and conditions.'
        ]);
        \DB::beginTransaction();
        try {
            $hospital = new Hospital();
            $hospital->hospital_name = $request->hospital_name;
            $hospital->province_id = $request->province;
            $hospital->district_id = $request->district;
            $hospital->municipality_id = $request->municipality;
            $hospital->ward = $request->ward;
            $hospital->transplant_type = $request->transplant_type;
            $hospital->hospital_type = $request->hospital_type;

            if ($request->hasFile('application_letter')) {
                $application_letter_path = $request->file('application_letter')->store('hospital_files', 'public');
                $hospital->application_letter = $application_letter_path;
            }
            if ($request->hasFile('human_resource')) {
                $human_resource_path = $request->file('human_resource')->store('hospital_files', 'public');
                $hospital->human_resource = $human_resource_path;
            }
            if ($request->hasFile('tools_list')) {
                $tools_list_path = $request->file('tools_list')->store('hospital_files', 'public');
                $hospital->tools_list = $tools_list_path;
            }
            if ($request->hasFile('administrative_document')) {
                $administrative_document_path = $request->file('administrative_document')->store('hospital_files', 'public');
                $hospital->administrative_document = $administrative_document_path;
            }
            if ($request->hasFile('sanchalan_swikriti')) {
                $sanchalan_swikriti_path = $request->file('sanchalan_swikriti')->store('hospital_files', 'public');
                $hospital->sanchalan_swikriti = $sanchalan_swikriti_path;
            }
            if ($request->hasFile('renewal_letter')) {
                $renewal_letter_path = $request->file('renewal_letter')->store('hospital_files', 'public');
                $hospital->renewal_letter = $renewal_letter_path;
            }
            if ($request->hasFile('pan')) {
                $pan_path = $request->file('pan')->store('hospital_files', 'public');
                $hospital->pan = $pan_path;
            }
            if ($request->hasFile('tax_clearance')) {
                $tax_clearance_path = $request->file('tax_clearance')->store('hospital_files', 'public');
                $hospital->tax_clearance = $tax_clearance_path;
            }
            if ($request->hasFile('infrastructural_document')) {
                $infrastructural_document_path = $request->file('infrastructural_document')->store('hospital_files', 'public');
                $hospital->infrastructural_document = $infrastructural_document_path;
            }

            $hospital->approve_status = HospitalApproveStatus::UNAPPROVED;
            $hospital->document_verification = HospitalDocumentVerification::UNVERIFIED;
            $hospital->physical_verification = HospitalPlysicalVerification::UNVERIFIED;
            $hospital->status = 0;
            $hospital->save();

            // setup login
            $user = new User();
            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->password = $this->defaultPasswordHashed();
            $user->user_type = UserType::HOSPITAL;
            $user->hospital_id = $hospital->id;
            $user->save();
            \DB::commit();

            $returnData = $this->prepareResponse(false, "Your form has been submitted successfully. Please check your email <strong>$user->email</strong> for approval message.", [], []);
            return response()->json($returnData);
        } catch(\Exception $exception){
            \DB::rollback();
//            throw new \Exception('Error while creating hospital.');
            throw new \Exception($exception->getMessage());
        }
    }
    public function update(Request $request){
        $request->validate([
            'hospital_name' => 'string|max:255',
            'province_id' => 'exists:provinces,id',
            'district_id' => 'exists:districts,id',
            'municipality_id' => 'exists:municipalities,id',
            'palika' => 'string|max:255',
            'transplant_type' => 'string',
            'hospital_type' => 'string',
            'application_letter' => 'mimes:png,jpeg,svg,jpg,pdf',
            'human_resource' => 'mimes:png,jpeg,svg,jpg,pdf',
            'tools_list' => 'mimes:png,jpeg,svg,jpg,pdf',
            'administrative_document' => 'mimes:png,jpeg,svg,jpg,pdf',
            'sanchalan_swikriti' => 'mimes:png,jpeg,svg,jpg,pdf',
            'renewal_letter' => 'mimes:png,jpeg,svg,jpg,pdf',
            'pan' => 'mimes:png,jpeg,svg,jpg,pdf',
            'tax_clearance' => 'mimes:png,jpeg,svg,jpg,pdf',
        ]);
        $hospital = Hospital::find(Auth::user()->hospital_id);
        $request->hospital_name && $hospital->hospital_name = $request->hospital_name;
        $request->province_id && $hospital->province_id = $request->province_id;
        $request->district_id && $hospital->district_id = $request->district_id;
        $request->municipality_id && $hospital->municipality_id = $request->municipality_id;
        $request->palika && $hospital->palika_name = $request->palika;
        $request->transplant_type && $hospital->transplant_type = $request->transplant_type;
        $request->hospital_type && $hospital->hospital_type = $request->hospital_type;

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

        $hospital->save();
        $hospital_id = auth()->user()->hospital_id;
        $hospital = Hospital::with([
            'province',
            'district',
            'municipality',
        ])->find($hospital_id);
        //save data
        $returnData = $this->prepareResponse(false, 'success', [$hospital], []);
        return response()->json($returnData);
    }
    public function notificationList(Request $request){
        $items = Activity::with('causer')->where(["causer_id" =>auth()->user()->id])->orderBy('id', 'desc')->paginate(10);
        $notifications=$items->setCollection(
            $items->getCollection()->transform(function ($value) {
                $subj=explode('\\',$value->subject_type);
                $value->subject_name = $subj[count($subj)-1];
                $value->created_at_diff_for_human = $value->created_at->diffForHumans();
                return $value;
            }));
        $returnData = $this->prepareResponse(false, 'success', [$notifications], []);
        return response()->json($returnData);
    }

}
