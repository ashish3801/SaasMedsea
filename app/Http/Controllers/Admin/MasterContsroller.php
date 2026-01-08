<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RankRequest;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterContsroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function rankStore(RankRequest $request)
    {
        // dd($request->all());
        $companyId = Auth::user()->company_id;
        
        $rank = Rank::create([
            'company_id' => $companyId,
            'name' => $request->name,
            'category' => $request->category,
            'food_handler' => $request->food_handler,
            'watchkeeper' => $request->watchkeeper,
            'created_by' => Auth::user()->id,
        ]);

        return response()->json(['id' => $rank->id, 'name' => $rank->name], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
