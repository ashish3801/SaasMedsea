<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTest;
use App\Models\Package;
use App\Models\Report;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillingPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::leftJoin('categories','categories.id','=','packages.category_id')
            ->select('packages.*','categories.name as category_name')
            ->get();

        return view('billing-package.index', compact('packages'));
    }

    public function create()
    {
        return view('billing-package.create_update', [
            'billingCategories' => Category::all(),
            'billingItems' => Test::all(),
            'reports' => Report::all(),
            'billingPackage' => null
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $selectedCategoryIds = $request->category_id ?? [];
            $selectedTestIds     = $request->test_id ?? [];

            $packageDetails = [];
            $filteredPackageDetails = [];

            $categories = Category::whereIn('id', $selectedCategoryIds)->get();

            foreach ($categories as $category) {
                $catTestIds = json_decode($category->test_id, true) ?? [];

                // Save full category test list
                $packageDetails[] = [
                    'category_id' => $category->id,
                    'tests' => $catTestIds
                ];

                // Save only selected tests
                $filtered = array_values(array_intersect($catTestIds, $selectedTestIds));

                if ($filtered) {
                    $filteredPackageDetails[] = [
                        'category_id' => $category->id,
                        'tests' => $filtered
                    ];
                }
            }

            $package = Package::create([
                'company_id' => Auth::user()->company_id,
                'name' => $request->name,
                'package_details' => json_encode($packageDetails),
                'category_id' => json_encode($selectedCategoryIds),
                'test_id' => json_encode($filteredPackageDetails), 
                'report_id' => json_encode($request->report_id),
                'other_category' => $request->other_category,
                'other_test' => $request->other_test,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
            ]);

            $syncCategories = [];
            foreach ($selectedCategoryIds as $catId) {
                $syncCategories[$catId] = ['company_id' => Auth::user()->company_id];
            }

            $syncTests = [];
            foreach ($selectedTestIds as $testId) {
                $syncTests[$testId] = ['company_id' => Auth::user()->company_id];
            }

            $package->categories()->sync($syncCategories);
            $package->tests()->sync($syncTests);

            DB::commit();
            return redirect()->route('billing-packages.index')->with('success', 'Package created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Package creation error: '.$e->getMessage());
            return back()->with('error', 'Failed to create package.')->withInput();
        }
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);

        // Decode JSON safely
        $package->category_id = json_decode($package->category_id, true) ?? [];
        $decodedTestGroups = json_decode($package->test_id, true) ?? [];

        // Extract all test ids
        $selectedTests = [];
        foreach ($decodedTestGroups as $group) {
            $selectedTests = array_merge($selectedTests, $group['tests']);
        }
        $package->test_id = $selectedTests;

        return view('billing-package.create_update', [
            'billingPackage' => $package,
            'billingCategories' => Category::all(),
            'billingItems' => Test::all(),
            'reports' => Report::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $package = Package::findOrFail($id);

            $selectedCategoryIds = $request->category_id ?? [];
            $selectedTestIds = $request->test_id ?? [];

            $packageDetails = [];
            $filteredPackageDetails = [];

            $categories = Category::whereIn('id', $selectedCategoryIds)->get();

            foreach ($categories as $category) {
                $catTestIds = json_decode($category->test_id, true) ?? [];

                $packageDetails[] = [
                    'category_id' => $category->id,
                    'tests' => $catTestIds
                ];

                $filtered = array_values(array_intersect($catTestIds, $selectedTestIds));

                if ($filtered) {
                    $filteredPackageDetails[] = [
                        'category_id' => $category->id,
                        'tests' => $filtered
                    ];
                }
            }

            $package->update([
                'company_id' => Auth::user()->company_id,
                'name' => $request->name,
                'package_details' => json_encode($packageDetails),
                'category_id' => json_encode($selectedCategoryIds),
                'test_id' => json_encode($filteredPackageDetails),
                'report_id' => json_encode($request->report_id),
                'other_category' => $request->other_category,
                'other_test' => $request->other_test,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
            ]);

            $package->categories()->sync($selectedCategoryIds);
            $package->tests()->sync($selectedTestIds);

            DB::commit();
            return redirect()->route('billing-packages.index')->with('success', 'Package updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Package update error: '.$e->getMessage());
            return back()->with('error','Failed to update package.')->withInput();
        }
    }

    public function getTestsByCategory(Request $request)
    {
        $categories = Category::whereIn('id', $request->category_id)->get();

        $testIds = [];
        foreach ($categories as $cat) {
            $testIds = array_merge($testIds, json_decode($cat->test_id, true) ?? []);
        }

        $tests = Test::whereIn('id', array_unique($testIds))->get();
        return response()->json($tests);
    }  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
