<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Employee;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicConroller extends Controller
{
    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = Clinic::with('city')->paginate(10); // Assuming you have a City relationship
        return view('clinic.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::select('id','name')->get();
        return view('clinic.create_update',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicRequest $request)
    {
        // dd($request->all());
        $company_id = Auth::user()->company_id;

        $clinic = Clinic::create([
            'company_id'=>$company_id,
            'name'=>$request->clinic_name,
            'city_id'=>$request->city,
            'address'=>$request->address,
            'branch'=>$request->branch,
            'email'=>$request->email,
            'phone'=>$request->contact_number,
            'logo'=>$this->upload($request->logo),
            'stamp'=>$this->upload($request->stamp),
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
       $clinic = Clinic::findOrFail($id);
       $cities = City::select('id','name')->get();
       return view('clinic.create_update',compact('clinic','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $cities = City::select('id','name')->get();
        return view('clinic.create_update',compact('clinic','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClinicRequest $request, string $id)
    {
        $clinic = Clinic::findOrFail($id);

        // dd($clinic);
        $data = [
            'name'=>$request->clinic_name,
            'email'=>$request->email,
            'phone'=>$request->contact_number,
            'city_id'=>$request->city,
            'add'=>$request->address,
            'branch'=>$request->branch
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

     public function getDoctorsByClinic($id){

        $emp = Employee::where('clinic_id', $id)->get();
        // dd($emp);
        // return response()->json($emp);

        return response()->json($emp->map(function ($emp) {
            return [
                'id' => $emp->id,
                'emp_name' => $emp->emp_name,
            ];
        }));
     }
    public function destroy(string $id)
    {
        //
    }
}