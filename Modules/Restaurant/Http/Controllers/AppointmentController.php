<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Restaurant\Entities\Appointment;

class AppointmentController extends Controller
{
    use SetResponse;

    public function listAppointments(Request $request)
    {
        $filter = $request->filter ? $request->filter : '';
        $per_page = $request->per_page ? $request->per_page : 20;

        $query = Appointment::query();
        $query->where('title', 'LIKE', '%'.$filter.'%')
            ->orderBy('id', 'desc');

        $appointments = $query->paginate($per_page);

        $returnData = $this->prepareResponse(false, 'success', compact('appointments'), []);
        return response()->json($returnData, 200);
    }

    public function index()
    {
        $appointments = Appointment::paginate(20);
        return view('restaurant::appointment.index', compact('appointments'));
    }

    public function create()
    {
        return view('restaurant::appointment.create');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('restaurant::appointment.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'contact' => 'required|max:255'
        ]);

        if ($request->id AND !blank($request->id)){
            $appointment = Appointment::findOrFail($request->id);
        }else{
            $appointment = new Appointment();
        }

        $appointment->title = $request->title;
        $appointment->contact = $request->contact;
        $appointment->description = $request->description;
        $appointment->save();

        session()->flash('success', 'Success <br> Appointment listing created/updated successfully.');
        return redirect()->route('appointment.index');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        session()->flash('success', 'Success <br> Appointment listing deleted successfully.');
        return redirect()->route('appointment.index');
    }
}
