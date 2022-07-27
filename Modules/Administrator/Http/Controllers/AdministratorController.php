<?php

namespace Modules\Administrator\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Hospital\Entities\Hospital;
use Modules\Hospital\Entities\Patient;
use Modules\Hospital\Enum\HospitalApproveStatus;
use Modules\Hospital\Enum\HospitalTypes;

class AdministratorController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_hospitals = Hospital::count();
        $hospital_type_gov = Hospital::where('hospital_type', HospitalTypes::GOVERNMENT)->count();
        $hospital_type_pvt = Hospital::where('hospital_type', HospitalTypes::PRIVATE)->count();
        $approved_hospitals = Hospital::where('approve_status', HospitalApproveStatus::APPROVED)->count();
        $unapproved_hospitals = Hospital::where('approve_status', HospitalApproveStatus::UNAPPROVED)->count();
        $rejected_hospitals = Hospital::where('approve_status', HospitalApproveStatus::REJECTED)->count();
        $total_patients = Patient::count();

        return view('administrator::index',
            compact('total_users',
                'total_hospitals',
                'hospital_type_gov',
                'hospital_type_pvt',
                'approved_hospitals',
                'unapproved_hospitals',
                'rejected_hospitals',
                'total_patients')
        );
        return view('administrator::index');
    }
}
