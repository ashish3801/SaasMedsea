<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::where('is_active', 1)->get();
        return view('agent.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Auth::user()->company;  // relationship: user belongsTo company
        return view('agent.create_update', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentRequest $request)
    {
        //  dd(Auth::user());
        $companyId = Auth::user()->company_id;
        
        $agent =  Agent::create([
            'company_id' => $companyId,
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'created_by' => Auth::user()->id,
        ]);

        // return $agent;

        if ($agent) {
            return redirect()->route('agents.index')->with('success', 'Data stored successfully.');
        } else {
            return redirect()->route('agents.create')->with('error', 'There was an error storing the data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent = Agent::where(['is_active' => 1, 'id' => $id])->firstOrFail();
        $company = Auth::user()->company;
        return view('agent.create_update', compact('agent', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent = Agent::where(['is_active' => 1, 'id' => $id])->firstOrFail();
        return view('agent.create_update', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentRequest $request, string $id)
    {
        $agent = Agent::findOrFail($id);
        // dd($agent);
        // $registration = Registration::findOrFail($id);

        // Update the registration record
        $agent->update([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
        ]);

        if ($agent) {
            return redirect()->route('agents.index')->with('success', 'Data Updated successfully.');
        } else {
            return redirect()->route('agents.index')->with('error', 'There was an error updating the data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->is_active = 0;
        $agent->save();

        if ($agent) {
            return redirect()->route('agents.index')->with('success', 'Data Deleted successfully.');
        } else {
            return redirect()->route('agents.index')->with('error', 'There was an error deleting the data.');
        }
    }
}
