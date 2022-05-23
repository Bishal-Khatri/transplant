<?php

namespace Modules\Hospital\Http\Controllers;

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
