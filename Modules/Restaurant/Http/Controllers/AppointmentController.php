<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Enum\CategoryType;
use App\Models\Category;
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
        $categories = Category::where('type', CategoryType::APPOINTMENT)->get();

        $category = $request->category ? $request->category : '';
        $filter = $request->filter ? $request->filter : '';
        $per_page = $request->per_page ? $request->per_page : 20;

        $query = Appointment::query();
        $query->with('category')->where('title', 'LIKE', '%'.$filter.'%')
            ->orderBy('id', 'desc');

        if (!blank($category)){
            $query->whereHas('category', function($query) use ($category) {
                $query->where('id', '=', $category);
            });
        }

        $appointments = $query->paginate($per_page);

        $returnData = $this->prepareResponse(false, 'success', compact('appointments', 'categories'), []);
        return response()->json($returnData, 200);
    }

    public function index()
    {
        $appointments = Appointment::with('category')->paginate(20);
        return view('restaurant::appointment.index', compact('appointments'));
    }

    public function create()
    {
        $categories = Category::where('type', CategoryType::APPOINTMENT)->get();
        return view('restaurant::appointment.create', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::where('type', CategoryType::APPOINTMENT)->get();
        $appointment = Appointment::findOrFail($id);
        return view('restaurant::appointment.create', compact('appointment', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'contact' => 'required|max:255',
            'category' => 'required',
        ]);

        if ($request->id AND !blank($request->id)){
            $appointment = Appointment::findOrFail($request->id);
        }else{
            $appointment = new Appointment();
        }

        $appointment->title = $request->title;
        $appointment->category_id = $request->category;
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
