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

class PatientController extends Controller
{
    use SetResponse,PatientTrait;

    public function getPatientList(Request $request)
    {
        $query = Patient::query();
        if (isset($request->filter) AND !blank($request->filter)){
            $query->where('name', 'LIKE', "%" . $request->filter . "%");
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
            'hospital'
        ])->paginate(10);

        $hospitals = Hospital::all();
        $returnData = $this->prepareResponse(false, 'success', compact('patients', 'hospitals'), []);
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

    public function index()
    {
        return view('administrator::pages.patient.index');
    }

    public function edit($patient_id)
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
            'disease',
            'hospital'
        ])->findOrFail($patient_id);
        $religions = Religion::all();
        $ethnic_groups = EthnicGroup::all();
        $education_levels = EducationLevel::all();
        $occupations = Occupation::all();
        $diseases = Disease::all();
        $auth_user = auth()->user();
        return view('administrator::pages.patient.edit', compact('patient', 'religions', 'ethnic_groups', 'education_levels', 'occupations', 'diseases', 'auth_user'));
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
