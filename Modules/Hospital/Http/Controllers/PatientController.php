<?php

namespace Modules\Hospital\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Administrator\Entities\EducationLevel;
use Modules\Administrator\Entities\EthnicGroup;
use Modules\Administrator\Entities\Occupation;
use Modules\Administrator\Entities\Religion;
use Modules\Hospital\Entities\Patient;

class PatientController extends Controller
{
    use SetResponse;

    public function getPatientList(Request $request)
    {
        $query = Patient::query();
        if (isset($request->filter) AND !blank($request->filter)){
            $query->where('name', 'LIKE', "%" . $request->filter . "%");
        }
        $patients = $query->paginate(10);

        $returnData = $this->prepareResponse(false, 'success', compact('patients'), []);
        return response()->json($returnData);
    }

    public function savePatient(Request $request)
    {
        $request->validate([
            'patient_image' => 'required',
            'patient_name' => 'required',
            'citizenship_number' => 'required',
        ]);

        $this->checkPatient($request);

        $patient = new Patient();

        if ($request->hasFile('patient_image')){
            $path = $request->file('patient_image')->store('patient_images', 'public');
            $patient->image = $path;
        }
        $patient->name = $request->patient_name;
        $patient->citizenship_number = $request->citizenship_number;

        $patient->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Patient registered successfully.', [], []);
        return response()->json($returnData);
    }

    public function updatePatient(Request $request)
    {
//        dd($request->all());
        if (!isset($request->page) OR blank($request->page)){
            return;
        }

        $request->validate([
            'patient_id' => 'required|integer',
        ]);

        $patient = Patient::findOrFail($request->patient_id);

        switch ($request->page){
            case 'personal_information':
                return $this->__updatePersonalInformation($request, $patient);
                break;
        }
    }

    public function __updatePersonalInformation($request, $patient)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
        ]);

        try{
            $patient->name = $request->name;
//            $patient->citizenship_number = $request->citizenship_number;
            $patient->image = '';
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
        return view('hospital::patient.index');
    }

    public function edit($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $religions = Religion::all();
        $ethnic_groups = EthnicGroup::all();
        $education_levels = EducationLevel::all();
        $occupations = Occupation::all();
        return view('hospital::patient.edit', compact('patient', 'religions', 'ethnic_groups', 'education_levels', 'occupations'));
    }
}
