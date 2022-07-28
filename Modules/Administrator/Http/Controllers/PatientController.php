<?php

namespace Modules\Administrator\Http\Controllers;

use App\Traits\PatientTrait;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\Disease;
use Modules\Administrator\Entities\EducationLevel;
use Modules\Administrator\Entities\EthnicGroup;
use Modules\Administrator\Entities\Occupation;
use Modules\Administrator\Entities\Religion;
use Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Entities\Patient;
use Modules\Hospital\Enum\PatientStatus;
use Modules\Hospital\Enum\TransplantTypes;

class PatientController extends Controller
{
    use SetResponse,PatientTrait;

    public function getPatientList(Request $request)
    {
        $query = Patient::query();

//        filters
        if (isset($request->query) AND !blank($request->query)){
            $query->where('name', 'LIKE', "%" . $request->filter . "%");
        }
        if (isset($request->t_t) AND !blank($request->t_t)){
            $query->where('transplant_type', $request->t_t);
        }

        if (isset($request->p_s) AND !blank($request->p_s)){
            $query->where('status', $request->p_s);
        }

        if (isset($request->b_t) AND !blank($request->b_t)){
            $query->where('blood_group', 'LIKE', "%" . $request->b_t . "%");
        }

        $query->with([
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
            'hospital'
        ]);
        $query->orderBy('created_at', 'DESC');
        $patients = $query->get();
//        $patients = $query->paginate(10);

        $hospitals = Hospital::all();
        $returnData = $this->prepareResponse(false, 'success', compact('patients', 'hospitals'), []);
        return response()->json($returnData);
    }

    public function getPatientCount()
    {
        $count['active'] = Patient::where('status', PatientStatus::ACTIVE)->count();
        $count['on_hold'] = Patient::where('status', PatientStatus::ON_HOLD)->count();
        $count['received'] = Patient::where('status', PatientStatus::RECEIVED)->count();
        $count['canceled'] = Patient::where('status', PatientStatus::CANCELED)->count();

        $returnData = $this->prepareResponse(false, 'success', compact('count'), []);
        return response()->json($returnData);
    }

    public function changePatientStatus(Request $request)
    {

        $request->validate([
            'patient_id' => 'required|integer',
            'patient_status' => 'required',
            'status_change_remark' => 'nullable',
        ]);

        $patient = Patient::findOrFail($request->patient_id);

        $patient->status = $request->patient_status;
        $patient->status_change_remark = $request->status_change_remark;
        $patient->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Status changed successfully.', [], []);
        return response()->json($returnData);
    }

    public function savePatient(Request $request)
    {

        $request->validate([
            'patient_image' => 'required',
            'patient_name' => 'required',
            'citizenship_number' => 'required',
            'transplant_center' => 'required',
            'gender' => 'required',
            'transplant_type' => 'required',
        ]);

        $this->checkPatient($request);

        $patient = new Patient();

        if ($request->hasFile('patient_image')){
            $path = $request->file('patient_image')->store('patient_images', 'public');
            $patient->image = $path;
        }
        $patient->name = $request->patient_name;
        $patient->citizenship_number = $request->citizenship_number;
        $patient->hospital_id = $request->transplant_center;
        $patient->gender = $request->gender;
        $patient->transplant_type = $request->transplant_type;
        $patient->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Patient registered successfully.', [], []);
        return response()->json($returnData);
    }

    private function checkPatient(Request $request)
    {
        if (Patient::where('name', $request->patient_name)->where('citizenship_number', $request->citizenship_number)->exists()){
            $request->validate([
                'unique_patient' => 'required'
            ], [
                'unique_patient.required' => "This record already exists in the system."
            ]);
        }
        return 'true';
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

    public function index()
    {
        return view('administrator::pages.patient.index');
    }

    public function edit($patient_id)
    {
        $religions = Religion::all();
        $ethnic_groups = EthnicGroup::all();
        $education_levels = EducationLevel::all();
        $occupations = Occupation::all();
        $diseases = Disease::all();
        $auth_user = auth()->user();
        return view('administrator::pages.patient.edit', compact('patient_id','religions', 'ethnic_groups', 'education_levels', 'occupations', 'diseases', 'auth_user'));
    }

    public function view($patient_id){
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
        return view('administrator::pages.patient.view', compact('patient'));
    }
}
