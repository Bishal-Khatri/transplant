<?php

namespace Modules\Hospital\Http\Controllers;

use App\Traits\PatientTrait;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\Disease;
use Modules\Administrator\Entities\EducationLevel;
use Modules\Administrator\Entities\EthnicGroup;
use Modules\Administrator\Entities\Occupation;
use Modules\Administrator\Entities\Religion;
use Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Entities\Patient;
use Modules\Hospital\Entities\PatientTransferLog;

class PatientController extends Controller
{
    use SetResponse, PatientTrait;

    public function getPatientList(Request $request)
    {
        $hospital = auth()->user()->hospital;

        $query = Patient::query();
        $query->where('hospital_id', $hospital->id);

        // filers
        if (isset($request->query) AND !blank($request->query)){
            $query->where('name', 'LIKE', "%" . $request->filter . "%");
        }

        if (isset($request->blood_type) AND !blank($request->blood_type)){
            $query->where('blood_group', 'LIKE', "%" . $request->blood_type . "%");
        }

        $patients = $query->with([
            'current_province',
            'current_district',
            'current_municipality',
            'permanent_province',
            'permanent_district',
            'permanent_municipality',
            'education_level',
            'occupation',
            'religion',
            'ethnic_group',
        ])->paginate(10);

        $returnData = $this->prepareResponse(false, 'success', compact('patients'), []);
        return response()->json($returnData);
    }

    public function savePatient(Request $request)
    {
        $request->validate([
            'patient_image' => 'nullable|image',
            'patient_name' => 'required',
            'citizenship_number' => 'required',
            'gender' => 'required',
            'transplant_type' => 'required',
        ]);

        $this->checkPatient($request);
        $hospital = auth()->user()->hospital;

        $patient = new Patient();

        if ($request->hasFile('patient_image')){
            $path = $request->file('patient_image')->store('patient_images', 'public');
            $patient->image = $path;
        }
        $patient->name = $request->patient_name;
        $patient->citizenship_number = $request->citizenship_number;
        $patient->hospital_id = $hospital->id;
        $patient->gender = $request->gender;
        $patient->transplant_type = $request->transplant_type;

        $patient->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Patient registered successfully.', compact('patient'), []);
        return response()->json($returnData);
    }

    public function updatePatient(Request $request)
    {
        if (!isset($request->page) OR blank($request->page)){
            return;
        }

        $request->validate([
            'patient_id' => 'required|integer',
        ]);

        $patient = Patient::findOrFail($request->patient_id);

        // dd($request->page);
        switch ($request->page){
            case 'personal_information':
                return $this->__updatePersonalInformation($request, $patient);
                break;
            case 'contact_information':
                return $this->__updateContactInformation($request, $patient);
                break;
            case 'address_information':
                return $this->__updateAddressInformation($request, $patient);
                break;
            case 'diagnosis_information':
                return $this->__updateDiagnosisInformation($request, $patient);
                break;
            default:
                return response()->json(['message' => 'Page not found.']);
                break;
        }
    }

    public function __updatePersonalInformation($request, $patient)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'image'=>'mimes:png,jpeg,svg,jpg',
            'marital_status' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
        ]);

        try{
            $patient->name = $request->name;
//            $patient->citizenship_number = $request->citizenship_number;
            //save image file
            if ($request->hasFile('image')){
                $path = $request->file('image')->store('patient_images', 'public');
                $patient->image  = $path;
            }
            $patient->gender = $request->gender;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->marital_status = $request->marital_status;
            $patient->occupation_id = $request->occupation;
            $patient->religion_id = $request->religion;
            $patient->education_level_id = $request->education_level;
            $patient->ethnic_group_id = $request->ethnic_group;
            $patient->nationality = $request->nationality;
            $patient->passport_number = $request->passport_number;
            $patient->father_name = $request->father_name;
            $patient->mother_name = $request->mother_name;
            $patient->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Patient updated successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }
    public function __updateContactInformation($request, $patient)
    {
        $request->validate([
            'relative_name' => 'required',
            'relation_with_relative' => 'required',
            'contact_number_1' => 'required',
            'contact_number_2' => 'required',
            'email_address' => 'required',
            // Address
            'permanent_province_id' => 'required',
            'permanent_district_id' => 'required',
            'permanent_municipality_id' => 'required',
            'permanent_ward' => 'required',
            'permanent_tole' => 'string|nullable',
            'current_province_id' => 'required',
            'current_district_id' => 'required',
            'current_municipality_id' => 'required',
            'current_ward' => 'required',
            'current_tole' => 'string|nullable',
        ]);
        try{
            $patient->relative_name = $request->relative_name;
            $patient->relation_with_relative = $request->relation_with_relative;
            $patient->contact_number_1 = $request->contact_number_1;
            $patient->contact_number_2 = $request->contact_number_2;
            $patient->email_address = $request->email_address;
            // address
            $patient->permanent_province_id = $request->permanent_province_id;
            $patient->permanent_district_id = $request->permanent_district_id;
            $patient->permanent_municipality_id = $request->permanent_municipality_id;
            $patient->permanent_ward = $request->permanent_ward;
            $patient->permanent_tole = $request->permanent_tole;
            $patient->current_province_id = $request->current_province_id;
            $patient->current_district_id = $request->current_district_id;
            $patient->current_municipality_id = $request->current_municipality_id;
            $patient->current_ward = $request->current_ward;
            $patient->current_tole = $request->current_tole;
            $patient->save();
            $returnData = $this->prepareResponse(false, 'Success <br> Patient updated successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }
    public function __updateAddressInformation($request,$patient){
        $request->validate([
            'permanent_province_id' => 'required',
            'permanent_district_id' => 'required',
            'permanent_municipality_id' => 'required',
            'permanent_ward' => 'required',
            'permanent_tole' => 'required',
            'current_province_id' => 'required',
            'current_district_id' => 'required',
            'current_municipality_id' => 'required',
            'current_ward' => 'required',
            'current_tole' => 'required',
        ]);

        try{
            $patient->permanent_province_id = $request->permanent_province_id;
            $patient->permanent_district_id = $request->permanent_district_id;
            $patient->permanent_municipality_id = $request->permanent_municipality_id;
            $patient->permanent_ward = $request->permanent_ward;
            $patient->permanent_tole = $request->permanent_tole;
            $patient->current_province_id = $request->current_province_id;
            $patient->current_district_id = $request->current_district_id;
            $patient->current_municipality_id = $request->current_municipality_id;
            $patient->current_ward = $request->current_ward;
            $patient->current_tole = $request->current_tole;
            $patient->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Patient updated successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }

    }
    public function __updateDiagnosisInformation($request, $patient){
        $request->validate([
            'disease' => 'required',
            'referred_by' => 'required',
            'transplant_type' => 'required',
        ]);
        try{
            $patient->referred_by = $request->referred_by;
            $patient->blood_group = $request->blood_group;
            $patient->transplant_type = $request->transplant_type;

            if ($request->transplant_type == 'kidney'){
                $patient->dialysis_start_date = $request->dialysis_start_date;
                $patient->pra = $request->pra;

                $patient->hla_a_m = $request->hla_a_m;
                $patient->hla_a_f = $request->hla_a_f;
                $patient->hla_b_m = $request->hla_b_m;
                $patient->hla_b_f = $request->hla_b_f;
                $patient->hla_dr_m = $request->hla_dr_m;
                $patient->hla_dr_f = $request->hla_dr_f;
                $patient->cdc_t_cell = $request->cdc_t_cell;
                $patient->cdc_B_cell = $request->cdc_B_cell;
                $patient->dsa_class_1 = $request->dsa_class_1;
                $patient->dsa_class_2 = $request->dsa_class_2;

                // reset liver field
                $patient->meld_score = null;
            }
            elseif ($request->transplant_type == 'liver'){
                $patient->meld_score = $request->meld_score;

                // reset kidney fileds
                $patient->dialysis_start_date = null;
                $patient->pra = null;

                $patient->hla_a_m = null;
                $patient->hla_a_f = null;
                $patient->hla_b_m = null;
                $patient->hla_b_f = null;
                $patient->hla_dr_m = null;
                $patient->hla_dr_f = null;
                $patient->cdc_t_cell = null;
                $patient->cdc_B_cell = null;
                $patient->dsa_class_1 = null;
                $patient->dsa_class_2 = null;
            }

            $patient->save();

            $diseases = json_decode($request->disease);
            $patient->disease()->sync($diseases);

            $returnData = $this->prepareResponse(false, 'Success <br> Patient updated successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }

    public function deletePatient($patient_id)
    {
        try {
            $patient = Patient::findOrFail($patient_id);
            $patient->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Patient deleted successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }


    }
    public function getPatient($patient_id)
    {
        try {
            $patient = Patient::with([
                'current_province',
                'current_district',
                'current_municipality',
                'permanent_province',
                'permanent_district',
                'permanent_municipality',
                'education_level',
                'occupation',
                'religion',
                'ethnic_group',
                'disease',
            ])->findOrFail($patient_id);

            $returnData = $this->prepareResponse(false, 'Success <br> Patient found successfully.', [
                'patient' => $patient
            ], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $returnData = $this->prepareResponse(true, "Fail <br> $message", [], []);
            return response()->json($returnData, 500);
        }
    }

    public function index()
    {
        $hospitals = Hospital::all();
        return view('hospital::patient.index', compact('hospitals'));
    }

    public function edit($patient_id)
    {
        $religions = Religion::all();
        $ethnic_groups = EthnicGroup::all();
        $education_levels = EducationLevel::all();
        $occupations = Occupation::all();
        $diseases = Disease::all();
        $auth_user = auth()->user();
        return view('hospital::patient.edit', compact('patient_id','religions', 'ethnic_groups', 'education_levels', 'occupations', 'diseases', 'auth_user'));
    }
    public function view($patient_id)
    {
        $patient = Patient::with([
            'current_province',
            'current_district',
            'current_municipality',
            'permanent_province',
            'permanent_district',
            'permanent_municipality',
            'education_level',
            'occupation',
            'religion',
            'ethnic_group',
        ])->findOrFail($patient_id);
        return view('hospital::patient.view', compact('patient'));
    }

    public function transferPatient(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|integer',
            'transplant_center' => 'required|integer',
            'transfer_remarks' => 'nullable|max:1000',
        ]);

        try{
            $user = auth()->user();
            $hospital = $user->hospital;
            if (!$hospital){
                return response()->json($this->prepareResponse(true, 'Error <br> Transfer hospital not available.', [], []));
            }

            $transfer_to_hospital = Hospital::findOrFail($request->transplant_center);

            $patient = Patient::findOrFail($request->patient_id);
            $patient->hospital_id = $transfer_to_hospital->id; // hospital id changed
            $patient->transfer_remarks = $request->transfer_remarks;
            $patient->save();

            // add log
            $transfer_log = new PatientTransferLog();
            $transfer_log->transferred_by_user = auth()->user()->id;
            $transfer_log->transferred_by_hospital = $hospital->id;
            $transfer_log->transferred_to_hospital = $transfer_to_hospital->id;
            $transfer_log->remark = $request->remark;
            $transfer_log->save();

            // Add log
            activity()
                ->causedBy($user)
                ->performedOn($patient)
                ->log("Transferred");
//                ->log("A patient ".$patient->name." is transferred from".$hospital->hospital_name." to ".$transfer_to_hospital->hospital_name);

            $returnData = $this->prepareResponse(false, 'Success <br> Patient transferred successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, 'Error <br> Error processing request.'.$exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }
}
