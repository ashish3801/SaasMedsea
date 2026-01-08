@extends('layout.layout')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-100">
                        <br>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Registration Table</h5>

                                <a href="{{ route('registrations.create') }}" class="btn btn-primary"><i
                                        class="ri-add-line"></i></a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Full Name</th>
                                            <th>Phone</th>
                                            <th>Referred By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($registrations)
                                            @foreach ($registrations as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->seafarer->f_name }} {{ $item->seafarer->l_name }}</td>
                                                    <td>{{ $item->seafarer->phone_no }}</td>
                                                    <td>
                                                        {{ $item->agent && $item->agent->name ? $item->agent->name : '-' }}
                                                    </td>
                                                    <td>
                                                         @php
                                                            $permissions = json_decode(auth()->user()->permissions ?? '[]');
                                                           
                                                        @endphp
                                                        @if(in_array('registration_create', $permissions))
                                                        <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#largeModal" data-id="{{ $item->id }}"><i
                                                                class="bi bi-basket"></i></a>
                                                        @endif
                                                        @if(in_array('registration_edit', $permissions))
                                                        <a href="{{ route('registrations.show', $item->id) }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="ri-edit-2-line"></i></a>
                                                        @endif
                                                        @if(in_array('registration_show', $permissions))
                                                        <a class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                            data-id="{{ $item->id }}" data-bs-target="#earlargeModal">
                                                            <i class="ri-file-add-fill"></i>
                                                        </a>
                                                        @endif
                                                        {{-- <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#verticalycentered"
                                                            data-id="{{ $item->id }}"><i
                                                                class="ri-download-2-line"></i>
                                                        </a> --}}
                                                        @if(in_array('registration_upload', $permissions))
                                                        <a class="btn btn-success btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#verticalycentered"
                                                            data-reports='@json($item->report_names)' 
                                                            data-id="{{ $item->id }}">
                                                            <i class="ri-download-2-line"></i>
                                                        </a>
                                                       @endif
                                                       @if(in_array('registration_download', $permissions))
                                                       <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="{{ $item->id }}">
                                                            <i class="bi bi-upload"></i>
                                                        </a>
                                                       @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12">No registrations found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>

    {{-- @include('registration.modal') --}}

    <!-- Medical Records Modal -->
    <div class="modal fade" id="earlargeModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Medical </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6>Loading Medical Records...</h6>
                        <p>Please wait while we load your medical records.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Medical Records Modal -->
    <!--- upload scan document Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form action="{{ route('upload.scan.docs') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="registration_id" id="uploadRegistrationId">
            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Documents</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div id="uploadedDocsContainer" class="mb-3">
                        <!-- Uploaded documents will appear here -->
                    </div>
    
                    <!-- Document Upload Fields -->
                   <!-- Make sure you include Bootstrap Icons in your project -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
                    
                    <div class="doc-upload-section">
                      <div class="mb-3 doc-row" data-doc="1">
                        <div class="d-flex align-items-center justify-content-between">
                          <label class="form-label fw-semibold mb-0">Document 1</label>
                          <div class="d-flex gap-2">
                            <!-- View Icon -->
                            <i class="bi bi-eye-fill text-primary view-btn d-none" style="cursor:pointer;"></i>
                            <!-- Delete Icon -->
                            <i class="bi bi-trash-fill text-danger delete-doc-btn d-none" style="cursor:pointer;"></i>
                          </div>
                        </div>
                        <input type="file" class="form-control mt-2" name="docs_1">
                      </div>
                    
                      <div class="mb-3 doc-row" data-doc="2">
                        <div class="d-flex align-items-center justify-content-between">
                          <label class="form-label fw-semibold mb-0">Document 2</label>
                          <div class="d-flex gap-2">
                            <i class="bi bi-eye-fill text-primary view-btn d-none" style="cursor:pointer;"></i>
                            <i class="bi bi-trash-fill text-danger delete-doc-btn d-none" style="cursor:pointer;"></i>
                          </div>
                        </div>
                        <input type="file" class="form-control mt-2" name="docs_2">
                      </div>
                    
                      <div class="mb-3 doc-row" data-doc="3">
                        <div class="d-flex align-items-center justify-content-between">
                          <label class="form-label fw-semibold mb-0">Document 3</label>
                          <div class="d-flex gap-2">
                            <i class="bi bi-eye-fill text-primary view-btn d-none" style="cursor:pointer;"></i>
                            <i class="bi bi-trash-fill text-danger delete-doc-btn d-none" style="cursor:pointer;"></i>
                          </div>
                        </div>
                        <input type="file" class="form-control mt-2" name="docs_3">
                      </div>
                    </div>

                </div>
    
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
      </div>
    </div>
    <!-- End Upload Scan Document Modal -->
    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download Reports</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div id="uploadedDocsContainer" class="mb-3">-->
                        <!-- Uploaded documents will appear here -->
                    <!--</div>-->

                    <form class="row" method="POST" action="{{ route('download-reports.store') }}"
                    id="downloadReportsForm" target="_blank">
                    @csrf
                    <input type="hidden" class="registerId" name="register_id" value="" readonly>
            
                    <div class="row justify-content-center" id="checkboxContainer">
                        {{-- Dynamically injected checkboxes will appear here --}}
                    </div>
                </form>
                <!--<div id="uploadedDocsContainer">Loading uploaded documents...</div>-->
                </div>
                <div class="modal-footer">
                    <a href="#" 
                       class="btn btn-info btn-sm send-mail-btn" 
                       id="sendMailBtn">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                    <button type="submit" class="btn btn-primary" form="downloadReportsForm">Download</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Medical Records </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="package-tab" data-bs-toggle="tab"
                                                    data-bs-target="#package" type="button" role="tab"
                                                    aria-controls="package" aria-selected="true">Package</button>
                                                <input type="hidden" class="registerId" name="register_id"
                                                    id="packageRegisterId" value="">
                                            </li>
                                            {{-- <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="test-tab" data-bs-toggle="tab"
                                                    data-bs-target="#test" type="button" role="tab"
                                                    aria-controls="test" aria-selected="false">Test</button>
                                                <input type="hidden" class="registerId" name="register_id"
                                                    id="testRegisterId" value="">
                                            </li> --}}
                                        </ul>

                                        <!-- Tab Content -->
                                        <div class="tab-content pt-2" id="myTabContent">
                                            <!-- Package Tab Content -->
                                            <div class="tab-pane fade show active" id="package" role="tabpanel"
                                                aria-labelledby="package-tab">
                                                <h5 class="card-title">Package</h5>
                                                <form id="package-form">
                                                    <table id="packageTable" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Select</th>
                                                                <th>Name</th>
                                                                <th>Price</th>
                                                                <th>Discount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="package-list">
                                                        </tbody>
                                                    </table>
                                                    <button type="button" id="submit-package-form"
                                                        class="btn btn-primary" style="margin-left: 50%;">Add</button>
                                                </form>
                                            </div>

                                            <!-- Test Tab Content -->
                                            <div class="tab-pane fade" id="test" role="tabpanel"
                                                aria-labelledby="test-tab">
                                                <h5 class="card-title">Test</h5>
                                                <form id="test-form">
                                                    <table id="testTable" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Select</th>
                                                                <th>Test Name</th>
                                                                <th>Price</th>
                                                                <th>Discount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="test-list">
                                                            <!-- Test data will be inserted here -->
                                                        </tbody>
                                                    </table>
                                                    <button type="button" id="submit-test-form" class="btn btn-primary"
                                                        style="margin-left: 50%;">Add</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- End Large Modal-->
    <!-- Start EarLarge Modal-->
    <div class="modal fade" id="earlargeModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Medical Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if (isset($categories) && $categories instanceof \Illuminate\Support\Collection && $categories->count() > 0)
                        <div class="category-tabs">
                            <!-- Debug Information -->
                            @if (config('app.debug'))
                                <div class="alert alert-info mb-3">
                                    <h6>Debug Information:</h6>
                                    <ul>
                                        <li>Total Categories: {{ $categories->count() }}</li>
                                        <li>Total Tests: {{ $tests->count() ?? 0 }}</li>
                                        <li>Categories: {{ $categories->pluck('name')->implode(', ') }}</li>
                                    </ul>
                                </div>
                            @endif

                            <!-- Category Tabs Navigation -->
                            <ul class="nav nav-tabs" id="categoryTabs" role="tablist">
                                @foreach ($categories as $index => $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                            id="tab-{{ $category->id }}" data-bs-toggle="tab"
                                            data-bs-target="#category-{{ $category->id }}" type="button"
                                            role="tab">
                                            {{ $category->name }}
                                            <span class="badge bg-secondary">{{ $category->tests->count() }}</span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Category Tab Contents -->
                            <div class="tab-content pt-3">
                                @foreach ($categories as $index => $category)
                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                        id="category-{{ $category->id }}" role="tabpanel">

                                        <h5>{{ $category->name }} Tests</h5>

                                        @php
                                            // Get tests for this category
                                            $categoryTests = $category->tests;

                                            // Special handling for CBC category
                                            $isCbcCategory = strtolower($category->name) === 'cbc examination';

                                            // Debug information
                                            Log::info('Processing category: ' . $category->name);
                                            Log::info('Tests in category: ' . $categoryTests->count());
                                            foreach ($categoryTests as $test) {
                                                Log::info("Test in category {$category->name}: " . $test->name);
                                            }
                                        @endphp

                                        @if ($categoryTests->count() > 0)
                                            <div class="test-forms">
                                                @if ($isCbcCategory)
                                                    @include('registration.include.cbc_form', [
                                                        'tests' => $categoryTests,
                                                        'registrationId' => $registerId ?? null,
                                                    ])
                                                @else
                                                    @foreach ($categoryTests as $test)
                                                        @php
                                                            $formMap = [
                                                                'Urine Examination' => 'urine_form',
                                                                'Serology Examination' => 'serology_form',
                                                                'Eye Examination' => 'eye_form',
                                                                'Ear Examination' => 'ear_form',
                                                                'USG Examination' => 'usg_form',
                                                                'ECG Examination' => 'ecg_form',
                                                                'DNA Examination' => 'dna_form',
                                                                'Physical Examination' => 'physical_form',
                                                                'Biochemistry Examination' => 'biochemistry_form',
                                                                'X-RAY Examination' => 'xray_form',
                                                                'Stool Routine' => 'stool_routin_form',
                                                                'TMT/Stress Examination' => 'stress_form',
                                                                '2D Echo Examination' => 'echo_form',
                                                            ];

                                                            // Try to find the form name
                                                            $formName = null;
                                                            $testNameVariations = [
                                                                $test->name,
                                                                $test->name . ' Examination',
                                                                str_replace(' Examination', '', $test->name),
                                                                Str::slug($test->name),
                                                            ];

                                                            foreach ($testNameVariations as $variation) {
                                                                if (isset($formMap[$variation])) {
                                                                    $formName = $formMap[$variation];
                                                                    break;
                                                                }
                                                            }

                                                            // If still not found, use slugified name
                                                            if (!$formName) {
                                                                $formName = Str::slug($test->name) . '_form';
                                                            }

                                                            // Debug information
                                                            Log::info('Processing test: ' . $test->name);
                                                            Log::info('Selected form name: ' . $formName);
                                                            Log::info(
                                                                'Form exists: ' .
                                                                    (view()->exists("registration.include.{$formName}")
                                                                        ? 'Yes'
                                                                        : 'No'),
                                                            );
                                                        @endphp

                                                        @if (view()->exists("registration.include.{$formName}"))
                                                            <!-- Debug comment -->
                                                            <!-- Including form: {{ $formName }} for test: {{ $test->name }} -->
                                                            @include("registration.include.{$formName}", [
                                                                'test' => $test,
                                                                'registrationId' => $registerId ?? null,
                                                            ])
                                                        @else
                                                            <div class="alert alert-warning">
                                                                <h6>Form Not Found</h6>
                                                                <p>Form template for {{ $test->name }} not found
                                                                    ({{ $formName }}.blade.php).</p>
                                                                <p>Please create the file in
                                                                    resources/views/registration/include/</p>
                                                                <div class="mt-2">
                                                                    <strong>Debug Information:</strong>
                                                                    <ul>
                                                                        <li>Test ID: {{ $test->id }}</li>
                                                                        <li>Test Name: {{ $test->name }}</li>
                                                                        <li>Category: {{ $category->name }}</li>
                                                                        <li>Attempted form name: {{ $formName }}</li>
                                                                        <li>Attempted variations:
                                                                            <ul>
                                                                                @foreach ($testNameVariations as $variation)
                                                                                    <li>{{ $variation }} ->
                                                                                        {{ isset($formMap[$variation]) ? $formMap[$variation] : 'not found' }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                <h6>No Tests Available</h6>
                                                <p>No tests available for this category in your assigned packages.</p>
                                                @if (config('app.debug'))
                                                    <div class="mt-2">
                                                        <strong>Debug Information:</strong>
                                                        <ul>
                                                            <li>Category ID: {{ $category->id }}</li>
                                                            <li>Category Name: {{ $category->name }}</li>
                                                            <li>Total Tests in System: {{ $tests->count() ?? 0 }}</li>
                                                            <li>Tests with this Category: {{ $categoryTests->count() }}
                                                            </li>
                                                            @if (isset($packageTestMapping[$category->id]))
                                                                <li>Tests from Package Mapping:
                                                                    {{ implode(', ', $packageTestMapping[$category->id]) }}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h6>No Records Available</h6>
                            <p>Please select a patient to view their medical records.</p>
                            @if (config('app.debug'))
                                <div class="mt-2">
                                    <strong>Debug Information:</strong>
                                    <ul>
                                        <li>Categories:
                                            {{ isset($categories) ? ($categories instanceof \Illuminate\Support\Collection ? $categories->count() : 'Not a collection') : 'Not set' }}
                                        </li>
                                        <li>Tests:
                                            {{ isset($tests) ? ($tests instanceof \Illuminate\Support\Collection ? $tests->count() : 'Not a collection') : 'Not set' }}
                                        </li>
                                        <li>Registration ID: {{ $registerId ?? 'Not set' }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- End EarLarge Modal-->

    <!-- End Vertically centered Modal-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const uploadModal = document.getElementById('uploadModal');
            
            uploadModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const regId = button.getAttribute('data-id');
                
                const hiddenInput = uploadModal.querySelector('#uploadRegistrationId');
                if (hiddenInput) {
                    hiddenInput.value = regId;
                }
            });
        });
    </script>

    
    <script>
        // Add this at the beginning of your script section
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '[data-bs-target="#largeModal"]', function() {
            console.log('Modal button clicked');
            var registerId = $(this).data('id');
            if (!registerId) {
                console.error("No registration ID found");
                return;
            }

            $('#packageRegisterId').val(registerId);
            $('#testRegisterId').val(registerId);

            // Initialize loading state
            var packageTable = $('#package-list');
            packageTable.empty();
            var testTable = $('#test-list');

            if ($.fn.DataTable.isDataTable('#packageTable')) {
                $('#packageTable').DataTable().destroy();
            }
            packageTable.html('<tr><td colspan="4" class="text-center">Loading packages...</td></tr>');
            testTable.html('<tr><td colspan="4" class="text-center">Loading tests...</td></tr>');

            // Get selected options first
            $.ajax({
                url: "/get-selected-options",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    registerId: registerId
                },
                success: function(selectedData) {
                    // console.log("Received selected data:", selectedData);

                 
                    $.ajax({
                        url: '/package-list/' + registerId,
                        type: 'GET',
                        success: function(data) {
                            // console.log("Received package data:", data);
                            packageTable.empty();

                            if (data.packages && data.packages.length > 0) {
                                data.packages.forEach(function(package) {
                                    let isSelected = selectedData.selected_packages.includes(package.id.toString());
                                    let discountValue = 0;

                                    let row = `<tr class="package-row">
                                        <td>
                                            <input type="checkbox" class="package-checkbox" 
                                                value="${package.id}" 
                                                ${isSelected ? 'checked' : ''}>
                                        </td>
                                        <td>${package.name}</td>
                                        <td>${package.price || 'N/A'}</td>
                                        <td>${discountValue || '0'}</td>
                                       
                                    </tr>`;
                                    packageTable.append(row);
                                });

                                // if ($.fn.DataTable.isDataTable('#packageTable')) {
                                //     $('#packageTable').DataTable().clear().destroy();
                                // }
                                $('#packageTable').DataTable({
                                    processing: true,
                                    paging: true,
                                    searching: true,
                                    info: true,
                                    lengthChange: true,
                                    pageLength: 10,
                                    columnDefs: [
                                        { orderable: false, targets: [0, 3] }
                                    ]
                                });

                            } else {
                                packageTable.append('<tr><td colspan="4" class="text-center">No packages found</td></tr>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching package details:", error);
                            packageTable.html(
                                `<tr><td colspan="4" class="text-center text-danger">Error loading packages: ${error}</td></tr>`
                            );
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching selected options:", error);
                    alert("Error loading selected options. Please try again.");
                }
            });
        });


        // Add event listener for checkbox changes to maintain selected state
        $(document).on('change', '.package-checkbox, .test-checkbox', function() {
            console.log('Checkbox changed:', $(this).val(), 'New state:', $(this).prop('checked'));
        });

        // Add this to handle modal cleanup
        $('#largeModal').on('hidden.bs.modal', function() {
            if ($.fn.DataTable.isDataTable('#packageTable')) {
                $('#packageTable').DataTable().destroy();
            }
            if ($.fn.DataTable.isDataTable('#testTable')) {
                $('#testTable').DataTable().destroy();
            }

            $('#package-list, #test-list').empty();
            $('#packageRegisterId, #testRegisterId').val('');
        });

        function initializeTables() {
            if (!$.fn.DataTable.isDataTable('#packageTable')) {
                packageTable = $('#packageTable').DataTable({
                    processing: true,
                    searching: true,
                    paging: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 3]
                    }]
                });
            }
            // ... similar for testTable
        }

       
    </script>
    <script>
        $(document).on('click', '[data-bs-target="#earlargeModal"]', function(e) {
            e.preventDefault();
            let registerId = $(this).data('id');

            if (!registerId) {
                console.error('No registration ID found');
                return;
            }

            $('#earlargeModal').data('current-registration-id', registerId);

            // Show loading state
            $('#earlargeModal .modal-content').html(`
                <div class="modal-header">
                    <h5 class="modal-title">Medical Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6>Loading Medical Records...</h6>
                        <p>Please wait while we load your medical records.</p>
                    </div>
                </div>
            `);

            $('#earlargeModal').modal('show');

            $.ajax({
                url: '/available-templates',
                type: 'GET',
                data: {
                    registerId: registerId
                },
                success: function(categories) {
                    if (Object.keys(categories).length === 0 || categories.error == 'no_packages') {
                        $('#earlargeModal .modal-body').html(`
                            <div class="alert alert-warning">
                                <h6>No Available Examinations</h6>
                                <p>The user does not have any assigned medical examinations.</p>
                            </div>
                        `);
                        return;
                    }
        
                    let tabsHtml = '';
                    let contentHtml = '';
                    let isFirst = true;
                    let allFormsData = {}; // Store all form data for save all functionality
        
                    // Add function to sanitize category names for use in IDs and selectors
                    function sanitizeCategoryName(category) {
                        return category
                            .replace(/[^a-zA-Z0-9-]/g, '-')
                            .replace(/-+/g, '-')
                            .replace(/^-|-$/g, '');
                    }
        
                    // Add dynamic category tabs
                    Object.keys(categories).forEach(category => {
                        let isActive = isFirst;
                        isFirst = false;
                        let sanitizedCategory = sanitizeCategoryName(category);
                        
                        tabsHtml += `
                            <li class="nav-item" role="presentation">
                                <button class="nav-link category-scroll-btn ${isActive ? 'active' : ''}"
                                        id="category-${sanitizedCategory}-tab"
                                        type="button"
                                        role="tab"
                                        data-category="${sanitizedCategory}">
                                    ${category}
                                </button>
                            </li>
                        `;
        
                        let formFields = '<div class="row">';
                        categories[category].forEach((test, index) => {
                            let existingValue = test.existing_result || '';
                            let fieldHtml = '';
                        
                            if (test.type === 'dropdown') {
                                let optionsHtml = '';
                                if (test.values && Array.isArray(test.values)) {
                                    optionsHtml = test.values.map(value => `
                                        <option value="${value}" ${value === existingValue ? 'selected' : ''}>${value}</option>
                                    `).join('');
                                }
                        
                                fieldHtml = `
                                    <div class="mb-3">
                                        <label class="form-label">${test.name}</label>
                                        <select class="form-control" name="results[${test.test_id}][result]" required>
                                            <option value="">Select Result</option>
                                            ${optionsHtml}
                                        </select>
                                    </div>
                                `;
                            } else {
                                fieldHtml = `
                                    <div class="mb-3">
                                        <label class="form-label">${test.name}</label>
                                        <input type="text" class="form-control" name="results[${test.test_id}][result]" value="${existingValue}" required>
                                    </div>
                                `;
                            }
                        
                            // Add column wrapper (3 columns per row = col-md-4)
                            formFields += `<div class="col-md-4">${fieldHtml}</div>`;
                        
                            // Close and open a new row every 3 columns
                            if ((index + 1) % 3 === 0) {
                                formFields += '</div><div class="row">';
                            }
                        });
                        formFields += '</div>'; // close the last row
        
                        // Create section content (not tab content)
                        contentHtml += `
                            <div class="category-section" id="category-${sanitizedCategory}" data-category="${category}">
                                <div class="section-header bg-light p-3 mb-4 rounded">
                                    <h4 class="section-title mb-0 text-primary">${category}</h4>
                                </div>
                                <form id="form-${sanitizedCategory}" class="dynamic-form category-form" data-register-id="${registerId}" data-category="${sanitizedCategory}">
                                    ${formFields}
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary btn-sm px-3" style="height: 42px;">
                                            <i class="ri-save-line"></i> Save ${category}
                                        </button>
                                </form>
                                <hr class="my-5">
                            </div>
                        `;
                    });
        
                    // Add Doctor Approval section at the bottom
                    contentHtml += `
                        <div class="category-section" id="doctor-approval-section">
                            <div class="section-header bg-light p-3 mb-4 rounded">
                                <h4 class="section-title mb-0 text-success">Doctor Approval</h4>
                            </div>
                            <form id="doctor-approval-form" class="static-form doctor-approval-form" data-register-id="${registerId}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Is Fit</label>
                                            <select class="form-control" name="is_fit" required>
                                                <option value="">Select</option>
                                                <option value="0">Unfit</option>
                                                <option value="1">Fit</option>
                                                <option value="2">Fit with limitation</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Limitation</label>
                                            <input type="text" class="form-control" name="limitation" placeholder="e.g. Color blindness" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Issue Date</label>
                                            <input type="date" class="form-control" name="issue_date" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Expiry Date</label>
                                            <input type="date" class="form-control" name="expiry_date" required />
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="attach_stamp_sign" id="attach_stamp_sign" value="1">
                                    <label class="form-check-label" for="attach_stamp_sign">Include Stamp on PDF</label>
                                </div>
        
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ri-file-download-line"></i> Save & Generate Certificate
                                    </button>
                                </div>
                            </form>
                        </div>
                    `;
        
                    // Add Save All button in header
                    let modalContent = `
                        <div class="modal-header d-flex justify-content-between align-items-center">
                            <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="flex-grow-1 text-center">
                                <h5 class="modal-title mb-0">Medical Records</h5>
                                <div id="alertContainer" class="mt-1"></div>
                            </div>
                            <button type="button" class="btn btn-warning btn-sm ms-2" id="save-all-btn">
                                <i class="ri-save-3-line"></i> Save All Tests
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="sticky-top bg-white shadow-sm" style="z-index: 1020;">
                                <div class="border-bottom">
                                    <div class="d-flex justify-content-center align-items-center p-3">
                                    </div>
                                    <ul class="nav nav-tabs flex-nowrap overflow-auto px-3" id="categoryTabs" role="tablist" style="max-height: 80px;">
                                        ${tabsHtml}
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-content-scrollable" style="max-height: calc(100vh - 200px); overflow-y: auto; padding: 20px;">
                                ${contentHtml}
                            </div>
                        </div>
                    `;
        
                    $('#earlargeModal .modal-content').html(modalContent);
        
                    // Initialize smooth scrolling for category navigation
                    initializeCategoryScrolling();
        
                    // Prefetch doctor approval form data
                    $.ajax({
                        url: '/fetch-data-approval',
                        type: 'GET',
                        data: { register_id: registerId },
                        success: function(response) {
                            const data = response.data;
                            if (data) {
                                const fitValue = data.is_fit == 1 ? '1' : (data.is_fit == 0 ? '0' : '');
                                $('#doctor-approval-form select[name="is_fit"]').val(fitValue);
                                $('#doctor-approval-form input[name="limitation"]').val(data.limitation);
                                $('#doctor-approval-form input[name="issue_date"]').val(data.issue_date);
                                $('#doctor-approval-form input[name="expiry_date"]').val(data.expiry_date);
                                $('#doctor-approval-form input[name="attach_stamp_sign"]').prop('checked', data.attach_stamp_sign == 1);
                            }
                        },
                        error: function() {
                            console.warn('Could not load existing doctor approval data.');
                        }
                    });
        
                    // Initialize Save All button functionality
                    initializeSaveAllButton(registerId);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading templates:', error);
                    $('#earlargeModal .modal-body').html(`
                        <div class="alert alert-danger">
                            <h6>Error Loading Templates</h6>
                            <p>There was an error loading the form templates: ${error}</p>
                        </div>
                    `);
                }
            });
        });
        
        // Function to initialize smooth category scrolling
        function initializeCategoryScrolling() {
            const categoryButtons = document.querySelectorAll('.category-scroll-btn');
            const modalContent = document.querySelector('.modal-content-scrollable');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-category');
                    const targetSection = document.getElementById(`category-${categoryId}`);
                    
                    if (targetSection) {
                        // Remove active class from all buttons
                        categoryButtons.forEach(btn => btn.classList.remove('active'));
                        // Add active class to clicked button
                        this.classList.add('active');
                        
                        // Smooth scroll to target section
                        const offsetTop = targetSection.offsetTop - 100; // Offset for sticky header
                        modalContent.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        
            // Update active category on scroll
            modalContent.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('.category-section');
                const scrollPosition = modalContent.scrollTop + 120; // Offset for sticky header
                
                let currentSection = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    
                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        currentSection = section.id.replace('category-', '');
                    }
                });
                
                // Update active button
                categoryButtons.forEach(button => {
                    const buttonCategory = button.getAttribute('data-category');
                    if (buttonCategory === currentSection) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                });
            });
        }
        
        // Function to initialize Save All button
        // Function to initialize Save All button
        function initializeSaveAllButton(registerId) {
            $('#save-all-btn').on('click', function() {
                const button = $(this);
                const originalText = button.html();
                
                button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Collecting Data...');
                
                // Collect all form data
                const allForms = $('.category-form');
                const categoriesData = [];
                
                allForms.each(function() {
                    const form = $(this);
                    const categoryName = form.data('category');
                    const formData = form.serializeArray();
                    
                    categoriesData.push({
                        category_name: categoryName,
                        results: formData
                    });
                });
                
                if (categoriesData.length === 0) {
                    showAlert('No test forms found to save.', 'warning');
                    button.prop('disabled', false).html(originalText);
                    return;
                }
                
                // Send all data to server
                $.ajax({
                    url: '/save-all-tests',
                    type: 'POST',
                    data: {
                        register_id: registerId,
                        categories_data: categoriesData,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving All Tests...');
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                // html: `
                                //     <div class="text-center">
                                //         <h5>${response.message}</h5>
                                //         <p class="mb-2">Saved: ${response.saved_count}/${response.total_categories} categories</p>
                                //         ${response.errors && response.errors.length > 0 ? 
                                //             '<details class="mt-3"><summary class="text-warning">View Errors</summary><small>' + 
                                //             response.errors.join('<br>') + '</small></details>' : ''
                                //         }
                                //     </div>
                                // `,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Save Failed',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred while saving all tests.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    },
                    complete: function() {
                        button.prop('disabled', false).html('<i class="ri-save-3-line"></i> Save All Tests');
                    }
                });
            });
        }
        
        // Helper function to save single form
        function saveSingleForm(registerId, categoryName, formData) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '/save-test-results',
                    type: 'POST',
                    data: {
                        register_id: registerId,
                        category_name: categoryName,
                        results: formData
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        resolve(response);
                    },
                    error: function(xhr) {
                        reject(xhr);
                    }
                });
            });
        }
        
        // Handle form submission for dynamic category forms (individual save)
        $(document).on('submit', '.dynamic-form', function(e) {
            e.preventDefault();
            var registerId = $(this).data('register-id');
            let form = $(this);
            let categoryName = $(this).data('category');
            
            let formData = form.serializeArray();
        
            $.ajax({
                url: `/save-test-results`,
                type: 'POST',
                data: {
                    register_id: registerId,
                    category_name: categoryName,
                    results: formData
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message || `${categoryName} saved successfully`,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: xhr.responseJSON?.message || `Failed to save ${categoryName}`,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                },
                complete: function() {
                    form.find('button[type="submit"]').prop('disabled', false).html('<i class="ri-save-line"></i> Save ' + categoryName);
                }
            });
        });
        
        // Handle form submission for doctor approval form
        $(document).on('submit', '#doctor-approval-form', function(e) {
            e.preventDefault();
            const form = $(this);
            const registerId = form.data('register-id');
            const formData = form.serialize();
            
            $.ajax({
                url: '/save-data-approval',
                type: 'POST',
                data: formData + '&register_id=' + registerId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message || 'Doctor approval saved successfully!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                    
                    setTimeout(() => {
                        if (response.certificate_url) {
                            window.open(response.certificate_url, '_blank');
                        }
                    }, 2000);
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while saving doctor approval.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
            
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: errorMessage,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                },
                complete: function() {
                    form.find('button[type="submit"]')
                        .prop('disabled', false)
                        .html('<i class="ri-file-download-line"></i> Save & Generate Certificate');
                }
            });
        });
        
        // Helper function to show alert messages
        function showAlert(message, type = 'success') {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('#alertContainer').html(alertHtml);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                $('.alert').alert('close');
            }, 5000);
        }
        
        // Handle modal close
        $('#earlargeModal').on('hidden.bs.modal', function() {
            // Reset modal content to loading state
            $(this).find('.modal-content').html(`
                <div class="modal-header">
                    <h5 class="modal-title">Medical Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6>Loading Medical Records...</h6>
                        <p>Please wait while we load your medical records.</p>
                    </div>
                </div>
            `);
        });


        // Helper function to load form templates
        function loadFormTemplate(template, registerId, categoryName) {
            $.ajax({
                url: `/load-template/${template}`,
                type: 'GET',
                data: {
                    register_id: registerId,
                    category_name: categoryName
                },
                success: function(response) {
                    $(`.form-container[data-template="${template}"]`).html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading form template:', error);
                    $(`.form-container[data-template="${template}"]`).html(`
                        <div class="alert alert-danger">
                            <h6>Error Loading Form</h6>
                            <p>Could not load the form for ${categoryName}.</p>
                            <p>Error: ${error}</p>
                        </div>
                    `);
                }
            });
        }

        // Handle modal close
        $('#earlargeModal').on('hidden.bs.modal', function() {
            // Reset modal content to loading state
            $(this).find('.modal-content').html(`
                <div class="modal-header">
                    <h5 class="modal-title">Medical Records </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6>Loading Medical Records...</h6>
                        <p>Please wait while we load your medical records.</p>
                    </div>
                </div>
            `);
        });



        function showAlert(message, type = 'success') {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show custom-alert-top" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            // ... rest of the alert code
        }


        $(document).ready(function() {
            // Detect tab change and set the correct register ID
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let activeTab = $(e.target).attr('id'); // Get active tab ID

                if (activeTab === "cbc-tab") {
                    let packageRegisterId = $("#packageRegisterId").val();
                    console.log("Package Register ID:", packageRegisterId);
                }

                if (activeTab === "test-tab") {
                    let testRegisterId = $("#packageRegisterId").val();
                    $("#testRegisterId").val(testRegisterId);
                    console.log("Test Register ID:", testRegisterId);
                }
            });

           
            // Click event for selecting package rows
            $(document).on("click", ".package-row", function(e) {
                if ($(e.target).is("input[type='checkbox']")) return;
                let checkbox = $(this).find(".package-checkbox");
                checkbox.prop("checked", !checkbox.prop("checked")).trigger("change");
            });

            // Submit Package Form
            $("#submit-package-form").on("click", function() {
                let checkedIds = [];
                $(".package-checkbox:checked").each(function() {
                    checkedIds.push($(this).val());
                });

                if (checkedIds.length === 0) {
                    alert("Please select at least one package.");
                    return;
                }

                let registerId = $("#packageRegisterId").val();
                let csrfToken = $('meta[name="csrf-token"]').attr("content");

                $.ajax({
                    url: "/package-registration",
                    type: "POST",
                    data: {
                        package_ids: checkedIds,
                        registerId: registerId,
                        _token: csrfToken
                    },
                    success: function(response) {
                        alert(response.message);
                        console.log(response);
                        // window.location.href = response.redirect_url;
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(xhr) {
                        alert("An error occurred while saving packages.");
                        console.error(xhr.responseText);
                    }
                });
            });

            // Click event for selecting test rows
            $(document).on("click", ".test-row", function(e) {
                if ($(e.target).is("input[type='checkbox']")) return;
                let checkbox = $(this).find(".test-checkbox");
                checkbox.prop("checked", !checkbox.prop("checked")).trigger("change");
            });

            // Submit Test Form
            $("#submit-test-form").on("click", function() {
                let checkedTestIds = [];
                $(".test-checkbox:checked").each(function() {
                    checkedTestIds.push($(this).val());
                });

                if (checkedTestIds.length === 0) {
                    alert("Please select at least one test.");
                    return;
                }

                let csrfToken = $('meta[name="csrf-token"]').attr("content");
                let registerId = $("#testRegisterId").val();
                console.log("Register ID:", registerId);

                if (!registerId) {
                    alert("Register ID is missing. Please try again.");
                    return;
                }

                $.ajax({
                    url: "/test-registration",
                    method: "POST",
                    data: {
                        test_ids: checkedTestIds,
                        registerId: registerId,
                        _token: csrfToken
                    },
                    success: function(response) {
                        alert("Tests saved successfully!");
                        console.log(response);
                        // window.location.href = response.redirect_url;
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(xhr) {
                        alert("An error occurred while saving tests.");
                        console.error(xhr.responseText);
                    }
                });
            });

        });
        @push('scripts')
            <
            script >
                $(document).ready(function() {
                    // Handle Medical Records Modal
                    $('#earlargeModal').on('show.bs.modal', function(event) {
                        const button = $(event.relatedTarget);
                        const registerId = button.data('id');
                        const modal = $(this);
                        const modalBody = modal.find('.modal-body');

                        modalBody.html(`
                                                    <div class="alert alert-info">
                                                        <h6>Loading Medical Records...</h6>
                                                        <p>Please wait while we load your medical records.</p>
                                                    </div>
                                                `);

                        $.get(`/medical-records/${registerId}`, function(response) {
                            modalBody.html(response);
                        }).fail(function() {
                            modalBody.html(`
                                                        <div class="alert alert-danger">
                                                            <h6>Error</h6>
                                                            <p>Failed to load medical records. Please try again.</p>
                                                        </div>
                                                    `);
                        });
                    });

                    // Handle Package/Test Modal
                    $('#largeModal').on('show.bs.modal', function(event) {
                        const button = $(event.relatedTarget);
                        const registerId = button.data('id');

                        $('#packageRegisterId, #testRegisterId').val(registerId);

                        // Load packages and tests
                        $.get('/packages', function(packages) {
                            $('#package-list').html(packages.map(package => `
                                                        <tr class="package-row">
                                                            <td><input type="checkbox" class="package-checkbox" value="${package.id}"></td>
                                                            <td>${package.name}</td>
                                                            <td>${package.price}</td>
                                                            <td>${package.discount}</td>
                                                        </tr>
                                                    `).join(''));
                        });

                        $.get('/tests', function(tests) {
                            $('#test-list').html(tests.map(test => `
                                                        <tr class="test-row">
                                                            <td><input type="checkbox" class="test-checkbox" value="${test.id}"></td>
                                                            <td>${test.name}</td>
                                                            <td>${test.price}</td>
                                                            <td>${package.discount}</td>
                                                        </tr>
                                                    `).join(''));
                        });
                    });

                    // Handle row clicks
                    $(document).on('click', '.package-row, .test-row', function(e) {
                        if (!$(e.target).is('input')) {
                            const checkbox = $(this).find('input[type="checkbox"]');
                            checkbox.prop('checked', !checkbox.prop('checked'));
                        }
                    });

                    

                    // Submit Test Form
                    $('#submit-test-form').on('click', function() {
                        const checkedTests = $('.test-checkbox:checked').map(function() {
                            const row = $(this).closest('tr');
                            return {
                                id: $(this).val(),
                                discount: row.find('.discount-input').val()
                            };
                        }).get();

                        if (!checkedTests.length) {
                            alert('Please select at least one test.');
                            return;
                        }

                        const registerId = $('#testRegisterId').val();
                        if (!registerId) {
                            alert('Register ID is missing. Please try again.');
                            return;
                        }

                        $.ajax({
                            url: '/test-registration',
                            method: 'POST',
                            data: {
                                tests: checkedTests,
                                register_id: registerId,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert('Tests saved successfully!');
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                }
                            },
                            error: function(xhr) {
                                alert('An error occurred while saving tests.');
                                console.error(xhr.responseText);
                            }
                        });
                    });
                });
        @endpush
    </script>

    <script>
        $(document).ready(function() {
            function handleTemplateLoadError(error, message) {
                if (error === 'no_packages') {
                    // Show package assignment modal
                    $('#assignPackageModal').modal('show');

                    // Load available packages
                    $.ajax({
                        url: '/package-list/' + $('#packageRegisterId').val(),
                        type: 'GET',
                        success: function(data) {
                            let packageTable = $('#package-list');
                            packageTable.empty();

                            if (data.packages && data.packages.length > 0) {
                                data.packages.forEach(function(package) {
                                    let row = `<tr class="package-row">
                                    <td>
                                        <input type="checkbox" class="package-checkbox" value="${package.id}">
                                    </td>
                                    <td>${package.name}</td>
                                    <td>${package.price || 'N/A'}</td>
                                    <td>
                                        <input type="number" class="discount-input form-control form-control-sm" 
                                            min="0" max="100" value="0">
                                    </td>
                                </tr>`;
                                    packageTable.append(row);
                                });
                            } else {
                                packageTable.append(
                                    '<tr><td colspan="4" class="text-center">No packages available</td></tr>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading packages:', xhr);
                            $('#package-list').html(
                                '<tr><td colspan="4" class="text-center text-danger">Error loading packages</td></tr>'
                            );
                        }
                    });
                } else {
                    // Show error message in the main modal
                    $('#largeModal .modal-body').html(`
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                        ${message}
                    </div>
                `);
                }
            }
            $('[data-bs-target="#largeModal"]').on('click', function() {
                var registerId = $(this).data('id');
                $('#packageRegisterId').val(registerId);
                // loadTemplates(registerId);
            });
        });
        
        function showSweetAlert(message, type = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
        
            Toast.fire({
                icon: type,
                title: message
            });
        }
       // Handle form submission for the static form
        $(document).on('submit', '#static-form', function(e) {
            e.preventDefault();
            const form = $(this);
            const registerId = form.data('register-id');
            const formData = form.serialize();
            
            $.ajax({
                url: '/save-data-approval',
                type: 'POST',
                data: formData + '&register_id=' + registerId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message || 'Special tests saved successfully!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                setTimeout(() => {
                        if (response.certificate_url) {
                            window.open(response.certificate_url, '_blank');
                        }
                    }, 2000);
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while saving special tests.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
            
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: errorMessage,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                },
                complete: function() {
                    form.find('button[type="submit"]')
                        .prop('disabled', false)
                        .html('Save & Generate Certificate');
                }
            });
        });
        // Handle form submission for dynamic forms
        $(document).on('submit', '.dynamic-form', function(e) {
            e.preventDefault();
            var registerId = $(this).data('register-id');
            let form = $(this);
            // let categoryName = form.closest('.tab-pane').attr('id').replace('category-', '');
            
            let formData = form.serializeArray();
            // console.log(registerId);

            $.ajax({
                url: `/save-test-results`,
                type: 'POST',
                data: {
                    register_id: registerId,
                    category_name: categoryName,
                    results: formData
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message || 'Results saved successfully',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: xhr.responseJSON?.message || 'Failed to save results',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false
                    });
                }
            });
        });

        // Helper function to show alert messages
        function showAlert(message, type = 'success') {
                const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show custom-alert-top" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            // Append the alert to the top of the page or a specific container
            $('#alertContainer').html(alertHtml);
        }

        // Handle modal close
        $('#earlargeModal').on('hidden.bs.modal', function() {
            // Reset modal content to loading state
            $(this).find('.modal-content').html(`
            <div class="modal-header">
                <h5 class="modal-title">Medical Records </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h6>Loading Medical Records...</h6>
                    <p>Please wait while we load your medical records.</p>
                </div>
            </div>
        `);
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const downloadModal = document.getElementById('verticalycentered'); // Download modal
        const checkboxContainer = document.getElementById('checkboxContainer');
        const form = document.getElementById('downloadReportsForm');

        downloadModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const reports = JSON.parse(button.getAttribute('data-reports'));
            const registerId = button.getAttribute('data-id');

            checkboxContainer.innerHTML = '';

            reports.forEach(reportName => {
                const formattedValue = reportName.toLowerCase().replace(/\s+/g, '_') + '_report';

                const checkboxDiv = document.createElement('div');
                checkboxDiv.className = 'col-md-6 col-lg-4 form-check custom-checkbox';

                checkboxDiv.innerHTML = `
                    <input type="checkbox" class="form-check-input" id="${formattedValue}" name="reports[]" value="${formattedValue}">
                    <label class="form-check-label" for="${formattedValue}">${reportName}</label>
                `;

                checkboxContainer.appendChild(checkboxDiv);
            });

            downloadModal.querySelector('.registerId').value = registerId;
        });

        form.addEventListener('submit', function (e) {
            const checkedReports = form.querySelectorAll('input[name="reports[]"]:checked');
            if (checkedReports.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Selection Required',
                    text: 'Please choose at least one report before downloading.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const uploadModal = document.getElementById('uploadModal');
    
    uploadModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const regId = button.getAttribute('data-id');
        uploadModal.querySelector('#uploadRegistrationId').value = regId;

        // Hide all view/delete buttons initially
        uploadModal.querySelectorAll('.view-btn, .delete-doc-btn').forEach(btn => btn.classList.add('d-none'));

        // Fetch existing documents
        fetch(`/registration/docs/${regId}`)
            .then(res => res.json())
            .then(data => {
                ['docs_1', 'docs_2', 'docs_3'].forEach((key, i) => {
                    const docRow = uploadModal.querySelector(`.doc-row[data-doc="${i+1}"]`);
                    const viewBtn = docRow.querySelector('.view-btn');
                    const deleteBtn = docRow.querySelector('.delete-doc-btn');

                    if (data[key]) {
                        const fileUrl = data[key];
                        viewBtn.classList.remove('d-none');
                        deleteBtn.classList.remove('d-none');

                        // Set View button action
                        viewBtn.onclick = () => window.open(fileUrl, '_blank');

                        // Set Delete button action
                        deleteBtn.onclick = () => {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'This document will be permanently deleted!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!'
                            }).then(result => {
                                if (result.isConfirmed) {
                                    fetch(`/registration/docs/delete`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            registration_id: regId,
                                            doc_key: key
                                        })
                                    })
                                    .then(res => res.json())
                                    .then(response => {
                                        if (response.status) {
                                            Swal.fire('Deleted!', response.message, 'success');
                                            viewBtn.classList.add('d-none');
                                            deleteBtn.classList.add('d-none');
                                        } else {
                                            Swal.fire('Error', response.message || 'Failed to delete document', 'error');
                                        }
                                    })
                                    .catch(() => Swal.fire('Error', 'Something went wrong', 'error'));
                                }
                            });
                        };
                    }
                });
            })
            .catch(() => console.error('Error loading document data'));
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ================================
        // SEND EMAIL BUTTON CLICK HANDLER
        // ================================
        // Use event delegation for dynamically updated button
        document.addEventListener('click', function(e) {
            if (e.target.closest('.send-mail-btn')) {
                const btn = e.target.closest('.send-mail-btn');
                const modal = btn.closest('.modal');
                
                // Get the registration ID from the hidden input in the modal form
                const registerId = modal.querySelector('.registerId').value;

                if (!registerId) {
                    Swal.fire("Error", "Registration ID not found!", "error");
                    return;
                }

                // Get selected reports
                const reports = [...modal.querySelectorAll('input[name="reports[]"]:checked')]
                                .map(r => r.value);

                if (reports.length === 0) {
                    Swal.fire("Error", "Please select at least one report to send!", "warning");
                    return;
                }

                Swal.fire({
                    title: "Send Email?",
                    text: "This will send the selected reports to the user.",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Send",
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/registration/send-mail/${registerId}`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({ reports })
                        })
                        .then(res => res.json())
                        .then(response => {
                            if (response.status) {
                                Swal.fire("Sent!", response.message, "success");
                            } else {
                                Swal.fire("Error", response.message, "error");
                            }
                        })
                        .catch(() => {
                            Swal.fire("Error", "Something went wrong!", "error");
                        });
                    }
                });
            }
        });

        // Update the modal show event to also handle the send-mail button data
        const downloadModal = document.getElementById('verticalycentered');
        downloadModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const reports = JSON.parse(button.getAttribute('data-reports'));
            const registerId = button.getAttribute('data-id');

            // ... existing code to populate checkboxes ...

            // Update the hidden input with registration ID
            downloadModal.querySelector('.registerId').value = registerId;
            
            // Update the send-mail button with the registration ID
            const sendMailBtn = downloadModal.querySelector('.send-mail-btn');
            if (sendMailBtn) {
                sendMailBtn.setAttribute('data-id', registerId);
            }
        });
    });
</script>
