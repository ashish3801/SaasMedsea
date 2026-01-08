<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Clinic;
use App\Models\Company;
use App\Models\Employee;
// use App\Traits\UploadFileTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpController extends Controller
{
    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emps = Employee::where('is_active', 1)->get();

        return view('employee.index', compact('emps'));
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
    public function store(EmployeeRequest $request)
    {
         //dd($request->all());
        if($request->signature){
             $signature = $this->upload($request->signature) ?? null;
        } 
        
        if($request->stamp){
             $stamp = $this->upload($request->stamp) ?? null;
        } 
       
        $companyId = Auth::user()->company_id;
        $emp = Employee::create([
            'company_id' => $companyId,
            'clinic_id' => $request->clinic,
            'emp_id' => $request->rank,
            'emp_name' => $request->name,
            'phone_no' => $request->contact_number,
            'email' => $request->email,
            'dgs_approval_number' => $request->dgs_approval_no,
            'certificate_issued_by' => $request->certificate_issued_by,
            'certificate_issue_date' => $request->certificate_issue_date,
            'sign_upload' =>  $signature ?? null,
            'stamp_upload' => $stamp ?? null,
            'created_by' => Auth::user()->id
        ]);

        if ($emp) {
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
        $clinic = Clinic::select('id', 'name')->get();
        $employee = Employee::findOrFail($id);
        return view('employee.create_update', compact('employee', 'clinic'));
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
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = [
            'company_id' => Auth::user()->company_id,
            'clinic_id' => $request->clinic,
            'emp_id' => $request->rank,
            'emp_name' => $request->name,
            'phone_no' => $request->contact_number,
            'email' => $request->email,
            'dgs_approval_number' => $request->dgs_approval_no,
            'certificate_issued_by' => $request->certificate_issued_by,
            'certificate_issue_date' => $request->certificate_issue_date,
            'created_by' => Auth::user()->id,
        ];
    
        if ($request->hasFile('signature')) {
            $data['sign_upload'] = $this->upload($request->signature);
        } else {
            $data['sign_upload'] = $employee->sign_upload;
        }
    
        if ($request->hasFile('stamp')) {
            $data['stamp_upload'] = $this->upload($request->stamp);
        } else {
            $data['stamp_upload'] = $employee->stamp_upload;
        }
    
        $employee->update($data);
    
        return response()->json(['message' => 'Success.'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
