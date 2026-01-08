@extends('layout.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">QR-Registration <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-hospital-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6> {{ $todayClinic }}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ $totalClinic }}</span> <span class="text-muted small pt-2 ps-1">Total</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Agents <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $todayClinic }}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ $toatalAgents }}</span> <span class="text-muted small pt-2 ps-1">Total</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card customers-card">
 
                <div class="card-body">
                  <h5 class="card-title">Registration <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $todayRegistrations }}</h6>
                      <span class="text-danger small pt-1 fw-bold">{{ $toatalRegistrations }}</span> <span class="text-muted small pt-2 ps-1">Total</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
                
                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                @php
                    // Encode PHP arrays as JSON for JavaScript use
                    $chartDates = json_encode($chartData['dates']);
                    $clinicSeries = json_encode($chartData['clinic']);
                    $agentSeries = json_encode($chartData['agent']);
                    $registrationSeries = json_encode($chartData['registration']);
                @endphp
                
                <!-- Line Chart -->
                <div id="reportsChart"></div>
                
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const chart = new ApexCharts(document.querySelector("#reportsChart"), {
                            series: [{
                                name: 'QR-Registration',
                                data: {!! $clinicSeries !!}
                            }, {
                                name: 'Agents',
                                data: {!! $agentSeries !!}
                            }, {
                                name: 'Registrations',
                                data: {!! $registrationSeries !!}
                            }],
                            chart: {
                                height: 350,
                                type: 'area',
                                toolbar: {
                                    show: false
                                },
                            },
                            markers: {
                                size: 4
                            },
                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100]
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2
                            },
                            xaxis: {
                                type: 'category',
                                categories: {!! $chartDates !!}
                            },
                            tooltip: {
                                x: {
                                    format: 'yyyy-MM-dd'
                                },
                            }
                        });
                        chart.render();
                    });
                </script>
                <!-- End Line Chart -->


                </div>

              </div>
            </div>
            <!-- End Reports -->

            <!-- Recent Sales -->
           <div class="col-12">
              <div class="card recent-sales overflow-auto">
            
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start"><h6>Filter</h6></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard', ['filter' => 'today']) }}">Today</a></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard', ['filter' => 'month']) }}">This Month</a></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard', ['filter' => 'year']) }}">This Year</a></li>
                  </ul>
                </div>
            
                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| {{ ucfirst($filter) }}</span></h5>
            
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Registrations</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($agentSales as $index => $agent)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td class="text-primary fw-bold">{{ $agent->name ?? 'N/A' }}</td>
                        <td>{{ $agent->registration_count }}</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="3">No data found</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
            
                </div>
              </div>
            </div>

            <!-- End Recent Sales -->

          <!-- Top Selling -->
          <div class="col-12">
            <div class="card top-selling overflow-auto">

              <!-- Filter -->
              <div class="filter">
                <form method="GET" id="filterForm">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start"><h6>Filter</h6></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard', ['filter' => 'today']) }}">Today</a></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard', ['filter' => 'month']) }}">This Month</a></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard', ['filter' => 'year']) }}">This Year</a></li>
                    
                    <hr class="my-2">
                    <li><h6 class="dropdown-header">Custom Range</h6></li>
                    <li>
                      <label for="start_date">Start Date</label>
                      <input type="date" name="start_date" class="form-control mb-2" id="start_date">
                    </li>
                    <li>
                      <label for="end_date">End Date</label>
                      <input type="date" name="end_date" class="form-control mb-2" id="end_date">
                    </li>
                    <li>
                      <input type="hidden" name="filter" value="custom">
                      <button type="submit" class="btn btn-sm btn-primary w-100">Apply</button>
                    </li>
                  </ul>
                </form>
              </div>

              <div class="card-body pb-0">
                <h5 class="card-title">Top Selling 
                  <span>
                    | 
                    @if($filter == 'today') Today
                    @elseif($filter == 'month') This Month
                    @elseif($filter == 'year') This Year
                    @else Last 7 Days
                    @endif
                  </span>
                </h5>

                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Sr.No</th>
                      <th scope="col">Package</th>
                      <th scope="col">Times Selected</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($topSellingPackages as $index => $item)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td class="text-primary fw-bold">{{ $item['package_name'] }}</td>
                        <td>{{ $item['count'] }}</td>
                      </tr>
                    @empty
                       <tr><td colspan="3">No data found</td></tr>
                    @endforelse


                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <!-- End Top Selling -->


          </div>
        </div><!-- End Left side columns -->

        
      </div>
    </section>

  </main>
@endsection