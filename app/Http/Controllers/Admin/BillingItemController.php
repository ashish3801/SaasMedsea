<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Test;
use Illuminate\Http\Request;

class BillingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Test::get();
        return view('billing-item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('billing-item.create_update');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $companyId = auth()->user()->company_id;
        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'field_type' => 'required|in:text,dropdown',
            'dropdown_values' => 'nullable|string',
            'text_value' => 'nullable|string',
        ]);

        $test = new Test();
        $test->company_id = $companyId;
        $test->name = $request->name;
        $test->price = $request->price;
        $test->discount_price = $request->discount_price;
        $test->field_type = $request->field_type;

        if ($test->field_type == 'dropdown') {
            $dropdownValues = array_filter(
                array_map('trim', explode(',', $request->input('dropdown_values', ''))),
                function($value) { return !empty($value); }
            );
            $test->dropdown_values = json_encode($dropdownValues);
        } elseif ($test->field_type == 'text') {
            $test->text_value = trim($request->input('text_value', ''));
            $test->dropdown_values = null;
        }
        
        $test->save();
        return  redirect()->back()->with('success', 'Test item created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $item = Test::Where('id', $id)->firstOrFail();
        return view('billing-item.create_update', compact('item'));
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
        $request->validate([
            'name' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'discount_price' => 'nullable|numeric',
        ]);

        $test = Test::findOrFail($id);
        $test->name = $request->name;
        $test->price = $request->price;
        $test->discount_price = $request->discount_price;
        $test->field_type = $request->field_type;

        if ($test->field_type == 'dropdown') {
            $dropdownValues = array_filter(
                array_map('trim', explode(',', $request->input('dropdown_values', ''))),
                function($value) { return !empty($value); }
            );
            $test->dropdown_values = json_encode($dropdownValues);
        } elseif ($test->field_type == 'text') {
            $test->text_value = trim($request->input('text_value', ''));
            $test->dropdown_values = null;
        }
        
        $test->save();

        return  redirect()->back()->with('success', 'Test item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
