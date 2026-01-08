<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoleRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Employee;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $emps = Employee::where('is_active', 1)->get();

        return view('user-role.index', compact('emps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinic = Clinic::select('id', 'name')->get();
        return view('employee.create_update', compact('clinic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRoleRequest $request)
    {
        $clinic = UserRole::create([
            'emp_name'=>$request->clinic_name,
            'city_id'=>$request->city,
            'address'=>$request->address,
            'email'=>$request->email,
            'contact_number'=>$request->contact_number,
           
        ]);

        if ($clinic) {
            return "Success.";
        } else {
            return "Something went wrong.";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $clinic = UserRole::findOrFail($id);
       $cities = City::select('id','name')->where('is_active',1)->get();
       return view('user-role.create_update',compact('clinic','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRoleRequest $request, string $id)
    {
        $clinic = UserRole::findOrFail($id);

        // dd($clinic);
        $data = [
            'name'=>$request->clinic_name,
            'email'=>$request->email,
            'phone'=>$request->contact_number,
            'city_id'=>$request->city,
            'add'=>$request->address
        ];

        // Handle file uploads if new files are provided
        if ($request->hasFile('logo')) {
            // Upload the new signature and add to data array
            $data['logo'] = $this->upload($request->logo);
        } else {
            // Retain the old signature if no new file is uploaded
            $data['logo'] = $clinic->logo;
        }

        if ($request->hasFile('stamp')) {
            // Upload the new stamp and add to data array
            $data['stamp'] = $this->upload($request->stamp);
        } else {
            // Retain the old stamp if no new file is uploaded
            $data['stamp'] = $clinic->stamp;
        }

        // Update the employee record
        $clinic->update($data);

        if ($clinic) {
            return "Success.";
        } else {
            return "Something went wrong.";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function editAccess($id)
    {
        $employee = Employee::with('role')->findOrFail($id);
        $roles = Role::all();
        $user = \App\Models\User::with('role')->where('email', $employee->email)->first();
        $permissions = Permission::all();

        $user = \App\Models\User::where('email', $employee->email)->first();

        $employeePermissions = [];

        if ($user && $user->permissions) {
            $employeePermissions = json_decode($user->permissions, true);
        }
        return view('user-role.access', compact('user','employee', 'roles', 'permissions', 'employeePermissions'));
    }

    public function updateAccess(Request $request, $id)
    {
        // dd($request->all());
        $employee = Employee::findOrFail($id);

        // Check if the user is admin (ID = 1), and prevent changes
        $user = User::where('email', $employee->email)->first();

        if ($user && $user->id === 1) {
            return redirect()->route('get-user-role.index')->with('error', 'You are not allowed to modify admin permissions.');
        }
        $request->validate([
            'role_id' => 'nullable|exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|max:50', // or string|in:... if you use keys
            'password' => 'nullable|min:6'
        ]);

        $employee->role_id = $request->role_id;
        $employee->save();

        // log::debug('empl');
        // log::debug($employee);

        $user = User::firstOrNew(['email' => $employee->email]);
       
        $user->name = $employee->emp_name;
        $user->email = $employee->email;
        $user->phone_no = $employee->phone_no;
        $user->role_id = 4;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        } else {
            // Generate a random password if not provided
            $user->password = Hash::make('12345678');
        }

        if ($request->has('permissions')) {
            $user->permissions = json_encode($request->permissions); // ['dashboard', 'billing_test']
        }
        $user->save();
      
       
        return redirect()->route('get-user-role.index')->with('success', 'Access updated successfully.');
    }
}
