<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Package;
use App\Models\QrRegistration;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = auth()->user();

        // Super Admin (role_id = 1) always gets dashboard access
        if ($user->role_id != 1) {
            $permissions = json_decode($user->permissions ?? '[]');

            if (!in_array('dashboard', $permissions)) {
                return view('blank');
            }
        }
        // === Totals ===
        $totalClinic = QrRegistration::count();
        $toatalAgents = Agent::count();
        $toatalRegistrations = Registration::count();

        // === Today counts ===
        $todayDate = Carbon::today()->toDateString();
        $todayClinic = QrRegistration::whereDate('created_at', $todayDate)->count();
        $todayAgent = Agent::whereDate('created_at', $todayDate)->count();
        $todayRegistrations = Registration::whereDate('created_at', $todayDate)->count();

        // === Filter Handling ===
        $filter = $request->input('filter', 'week');
        $customStart = $request->input('start_date');
        $customEnd = $request->input('end_date');

        if ($filter === 'today') {
            $startDate = Carbon::today();
            $endDate = Carbon::today()->endOfDay();
        } elseif ($filter === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now();
        } elseif ($filter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now();
        } elseif ($filter === 'custom' && $customStart && $customEnd) {
            $startDate = Carbon::parse($customStart)->startOfDay();
            $endDate = Carbon::parse($customEnd)->endOfDay();
        } else {
            $startDate = Carbon::now()->subDays(6)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        }
        
        if ($filter === 'custom' && $customStart && $customEnd) {
            $startDate = Carbon::parse($customStart)->startOfDay();
            $endDate = Carbon::parse($customEnd)->endOfDay();
        }
        // === Range counts ===
        $rangeClinic = QrRegistration::whereBetween('created_at', [$startDate, $endDate])->count();
        $rangeAgents = Agent::whereBetween('created_at', [$startDate, $endDate])->count();
        $rangeRegistrations = Registration::whereBetween('created_at', [$startDate, $endDate])->count();

        // === Chart data ===
        $chartData = $this->getFilteredChartData($startDate, $endDate);

        // === Top Selling Packages ===
        $packageCounts = DB::select("
                        SELECT 
                            jt.package_id, COUNT(*) as total
                        FROM user_packages,
                        JSON_TABLE(user_packages.package_id, '$[*]' COLUMNS (package_id INT PATH '$')) AS jt
                        WHERE user_packages.created_at BETWEEN ? AND ?
                        GROUP BY jt.package_id
                    ", [$startDate, $endDate]);

        
        $counts = collect($packageCounts)->keyBy('package_id')->map(fn($row) => $row->total);

        $topSellingPackages = Package::all()->map(function ($package) use ($counts) {
            return [
                'package_id' => $package->id,
                'package_name' => $package->name,
                'count' => $counts[$package->id] ?? 0,
            ];
        });
       $agentSales = Agent::withCount([
                        'registrations as registration_count' => function ($query) use ($startDate, $endDate) {
                            $query->whereBetween('created_at', [$startDate, $endDate]);
                        }
                    ])->get();
        return view('index', compact(
            'totalClinic',
            'toatalAgents',
            'toatalRegistrations',
            'todayRegistrations',
            'todayAgent',
            'todayClinic',
            'rangeClinic',
            'rangeAgents',
            'rangeRegistrations',
            'startDate',
            'endDate',
            'chartData',
            'filter',
            'topSellingPackages',
            'agentSales'
        ));
    }
    protected function getWeeklyChartData()
    {
        $startDate = Carbon::now()->subDays(6);
        $dates = [];
        $clinicData = [];
        $agentData = [];
        $registrationData = [];
    
        for ($i = 0; $i <= 6; $i++) {
            $date = $startDate->copy()->addDays($i)->toDateString();
            $dates[] = $date;
            $clinicData[] = QrRegistration::whereDate('created_at', $date)->count();
            $agentData[] = Agent::whereDate('created_at', $date)->count();
            $registrationData[] = Registration::whereDate('created_at', $date)->count();
        }
    
        return [
            'dates' => $dates,
            'clinic' => $clinicData,
            'agent' => $agentData,
            'registration' => $registrationData,
        ];
    }
    protected function getFilteredChartData($startDate, $endDate)
    {
        $dates = [];
        $clinicData = [];
        $agentData = [];
        $registrationData = [];
    
        $period = Carbon::parse($startDate)->daysUntil($endDate);
    
        foreach ($period as $date) {
            $formatted = $date->toDateString();
            $dates[] = $formatted;
            $clinicData[] = QrRegistration::whereDate('created_at', $formatted)->count();
            $agentData[] = Agent::whereDate('created_at', $formatted)->count();
            $registrationData[] = Registration::whereDate('created_at', $formatted)->count();
        }
    
        return [
            'dates' => $dates,
            'clinic' => $clinicData,
            'agent' => $agentData,
            'registration' => $registrationData,
        ];
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
    public function store(Request $request)
    {
        //
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
