<?php

namespace Modules\User\Http\Controllers;

use App\Enum\UserType;
use App\Models\User;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use SetResponse;

    public function index()
    {
        return view('user::index');
    }

    public function roleIndex()
    {
        return view('user::role.index');
    }


    public function userListing(Request $request)
    {
        $user_type = UserType::SUBSCRIBER;
        if ($request->has('user_type') AND !blank($request->user_type)){
            $user_type = $request->user_type;
        }

        $users = User::where('user_type', $user_type)->with('roles')->paginate(20);
        $roles = Role::all();

        $returnData = $this->prepareResponse(false, 'success', compact('users', 'roles'), []);
        return response()->json($returnData, 200);
    }

    public function roleListing()
    {
        $roles = Role::all();

        $returnData = $this->prepareResponse(false, 'success', compact('roles'), []);
        return response()->json($returnData, 200);
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'contact' => 'required',
            'role' => 'required',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->contact;
            $user->user_type = UserType::ADMINISTRATOR;
            $user->password = Hash::make($request->password);
            $user->save();

            $role = Role::findOrFail($request->role);
            $user->assignRole($role);

            $returnData = $this->prepareResponse(false, 'Success<br>Administrator created successfully', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

    public function edit($id)
    {
        return view('user::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
