<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('billing-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        // $tests  = Test::get();
        $testIdsRaw = Category::pluck('test_id')->toArray();

        $assignedTestIds = [];
    
        foreach ($testIdsRaw as $item) {
            if ($item) {
                $decoded = json_decode($item, true); 
                if (is_array($decoded)) {
                    $assignedTestIds = array_merge($assignedTestIds, $decoded);
                }
            }
        }
        $assignedTestIds = array_unique(array_map('intval', $assignedTestIds));
        
        // $tests = Test::whereNotIn('id', $assignedTestIds)->get();
        $tests = Test::whereNotIn('id', $assignedTestIds)->orderBy('position', 'asc')->get();
        return view('billing-category.create_update', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'test_id' => 'nullable|array',
            'test_id.*' => 'exists:tests,id',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the category
           $category = Category::create([
                'company_id' => Auth::user()->company_id,
                'name' => $request->name,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'test_id' => !empty($request->test_id) ? json_encode($request->test_id) : null,
            ]);
            
            if (!empty($request->test_id)) {
                $category->tests()->attach($request->test_id);
            }

            DB::commit();
            return redirect()->route('billing-categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $billingCategory = Category::where('id', $id)->firstOrFail();

        if (request()->ajax()) {
            return response()->json([
                'name' => $billingCategory->name,
                'price' => $billingCategory->price,
                'discount_price' => $billingCategory->discount_price,
                'tests' => $billingCategory->tests->map(function ($test) {
                    return [
                        'name' => $test->name,
                        'price' => $test->price,
                    ];
                }),
            ]);
        }

        $tests  = Test::get();
        return view('billing-category.create_update', compact('billingCategory', 'tests'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $billingCategory = Category::findOrFail($id);
    
  
        // $tests = Test::all();
        $tests = Test::orderBy('position', 'asc')->get();
     
        return view('billing-category.create_update', compact('billingCategory', 'tests'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'test_id' => 'nullable|array',
            'test_id.*' => 'exists:tests,id',
        ]);

        try {
            $category = Category::findOrFail($id);

            $category->update([
                'company_id' => Auth::user()->company_id,
                'name' => $request->name,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
            ]);

            // Prepare pivot data with company_id
            $syncData = [];
            if (!empty($request->test_id)) {
                foreach ($request->test_id as $testId) {
                    $syncData[$testId] = ['company_id' => Auth::user()->company_id];
                }
            }
            $category->tests()->sync($syncData);

            return redirect()->route('billing-categories.index')->with('success', 'Category updated successfully.');

        } catch (\Exception $e) {
            Log::error("Category update failed: " . $e->getMessage());
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignItems(Request $request, $categoryId)
    {
        $request->validate([
            'test_ids' => 'required|array',
            'test_ids.*' => 'exists:tests,id',
        ]);

        $category = Category::findOrFail($categoryId);
        $category->tests()->sync($request->test_ids);

        return response()->json(['message' => 'Items assigned to category successfully']);
    }
}
