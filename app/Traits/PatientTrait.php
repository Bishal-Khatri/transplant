<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Modules\Hospital\Entities\Patient;

trait PatientTrait{


    public function checkPatient(Request $request)
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

}
