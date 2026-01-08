<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorRequest;
use App\Http\Requests\CompanyRequest;
use App\Models\Administrator;
use App\Models\Company;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create_update');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = Company::create([
            'name'    => $request->name,
            'address' => $request->address,
            'email'   => $request->email,
            'contact' => $request->contact,
            'logo'    => $this->upload($request->logo)
        ]);

        if ($company) {
            return redirect()->route('company.create')->with('success', 'Company saved successfully.');
        } else {
            return redirect()->route('company.create')->with('error', 'There was an error storing the data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $company = Company::findOrFail($id);
       return view('company.create_update',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companies = Company::findOrFail($id);
        return view('company.create_update', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::findOrFail($id);
        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'is_active' => $request->is_active
        ];

      
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->upload($request->logo);
        } else {
           
            $data['logo'] = $company->logo;
        }

        $company->update($data);

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('company.index')->with('success', 'Company deleted successfully.');
    }

    // This is for Administrator

    public function administratorIndex()
    {
        // Only company admins (role_id = 2)
        $administrators = User::where('role_id', 2)->paginate(10);
        return view('administrator.index', compact('administrators'));
    }

    public function administratorCreate()
    {
        $companies = Company::all();
        return view('administrator.create_update', compact('companies'));
    }

    public function administratorStore(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'nullable|min:6',
        ]);

        $password =  Hash::make($request->password ?? '12345678');
        $permission = ["dashboard","registration","registration_create",
                        "registration_edit","registration_show","registration_delete",
                        "registration_upload","registration_download","billings","billing_test",
                        "billing_category","billing_package","employee","clinic","agent","user_role","qr_registration"
                    ];
        $admin = User::create([
            'company_id' => $request->company_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone_no'   => $request->phone_no,
            'password'   => $password,
            'role_id'    => 2,   // company admin role
            'is_active'  => 1,
            'permissions'  => json_encode($permission),
        ]);

        return redirect()->route('administrator.index')->with('success', 'Administrator created successfully.');
    }

    public function administratorShow(string $id)
    {
        $administrator = User::where('role_id', 2)->findOrFail($id);
        $companies = Company::all();

        return view('administrator.create_update', compact('administrator', 'companies'));
    }

    public function administratorEdit(string $id)
    {
        $administrator = User::where('role_id', 2)->findOrFail($id);
        $companies = Company::all();

        return view('administrator.create_update', compact('administrator', 'companies'));
    }

    public function administratorUpdate(Request $request, string $id)
    {
        $administrator = User::where('role_id', 2)->findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $administrator->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone_no'   => $request->phone_no,

        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $administrator->update($data);

        return redirect()
            ->route('administrator.index')
            ->with('success', 'Administrator updated successfully.');
    }

    public function administratorDestroy(string $id)
    {
        $administrator = User::where('role_id', 2)->findOrFail($id);
        $administrator->delete();

        return redirect()->route('administrator.index')
                        ->with('success', 'Administrator deleted successfully.');
    }
}
