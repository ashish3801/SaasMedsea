@extends('layout.layout')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@if(isset($registration))Edit Registration Form 1
                            @else
                           New Registration Form
                            @endif
                                    </h5>
                            <form method="POST"
                                action="{{ isset($registration) ? route('registrations.update', $registration->id) : route('registrations.store') }}"
                                class="row g-3" enctype="multipart/form-data">
                                @csrf
                                @if (isset($registration))
                                    @method('PUT')
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <label for="indos_no" class="form-label">Indos No.</label>
                                    <input type="text" class="form-control" id="indos_no" name="indos_no"
                                        value="{{ old('indos_no', isset($registration) ? $registration->indos_no : '') }}"
                                        required>
                                    <input type="hidden" id="register_no" name="register_no"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="passport_no" class="form-label">Passport No.</label>
                                    <input type="text" class="form-control" id="passport_no" name="passport_no"
                                        value="{{ old('passport_no', isset($registration) ? $registration->passport_no : '') }}"
                                        required>
                                </div>


                                <div class="col-md-4">
                                    <label for="cdc_no" class="form-label">CDC No.</label>
                                    <input type="text" class="form-control" id="cdc_no" name="cdc_no"
                                        value="{{ old('cdc_no', isset($registration) ? $registration->cdc_no : '') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name', isset($registration) ? $registration->seafarer->f_name : '') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                                        value="{{ old('middle_name', isset($registration) ? $registration->seafarer->m_name : '') }}"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name', isset($registration) ? $registration->seafarer->l_name : '') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob"
                                        value="{{ old('dob', isset($registration) ? $registration->seafarer->dob : '') }}"
                                         >
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="pob" class="form-label">Place of birth</label>
                                    <input type="text" class="form-control" id="pob" name="pob"
                                        value="{{ old('pob', isset($registration) ? $registration->seafarer->pob : '') }}"
                                         >
                                </div>

                                <div class="col-md-4">
                                    <label for="rank" class="form-label">Rank</label>
                                    <div class="input-group">
                                        <select name="rank" class="form-control" id="rank">
                                            <option value="">--select--</option>
                                            @if ($ranks && count($ranks) > 0)
                                                @foreach ($ranks as $rank)
                                                    <option value="{{ $rank->id }}"
                                                        {{ old('rank', isset($registration) ? $registration->rank_id : '') == $rank->id ? 'selected' : '' }}>
                                                        {{ $rank->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">No ranks available. Please add one.</option>
                                            @endif
                                        </select>
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#addRankModal">Add Rank</button>
                                    </div>
                                </div>
                                


                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" class="form-control" id="gender" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="1"
                                            {{ old('gender', isset($registration) ? $registration->seafarer->gender : '') == '1' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="2"
                                            {{ old('gender', isset($registration) ? $registration->seafarer->gender : '') == '2' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                        <option value="3"
                                            {{ old('gender', isset($registration) ? $registration->seafarer->gender : '') == '3' ? 'selected' : '' }}>
                                            Others
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <select name="nationality" class="form-control" id="nationality" >
                                        <!--<option value="">--select--</option>-->
                                        @if ($nationalities && count($nationalities) > 0)
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}"
                                                    {{ old('nationality', isset($registration) ? $registration->nationality_id : '') == $nationality->id ? 'selected' : '' }}>
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">No nationalities available. Please add one.</option>
                                        @endif
                                    </select>

                                    <!-- Add nationality form (if needed) -->
                                    {{-- @if (!$nationalities || count($nationalities) == 0)
                                        <div class="mt-2">
                                            <input type="text" name="new_nationality" class="form-control"
                                                placeholder="Enter new nationality" required>
                                        </div>
                                    @endif --}}

                                </div>

                                <div class="col-md-4">
                                    <label for="clinic" class="form-label">Clinic</label>
                                    <select name="clinic" class="form-control" id="clinic"  >
                                        <option value="">--select--</option>
                                        @if ($clinic && count($clinic) > 0)
                                            @foreach ($clinic as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ old('clinic', isset($registration) ? $registration->clinic_id : '') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">No clinic available. Please add one.</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mt-3">
                                    <label for="doctor" class="form-label">Doctor</label>
                                    <select name="doctor" class="form-control" id="doctor"  >
                                        <option value="">--select doctor--</option>
                                        @if (isset($registration) && $registration->employee)
                                            <option value="{{ $registration->employee->id }}" selected>
                                                {{ $registration->employee->emp_name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="company_name" class="form-label">Company Name (For Medical)</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        value="{{ old('company_name', isset($registration) ? $registration->company_name : '') }}"
                                         >
                                </div>

                                <div class="col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', isset($registration) ? $registration->address : '') }}"
                                         >
                                </div>

                                <div class="col-md-4">
                                    <label for="vessel_name" class="form-label">Vessel Name</label>
                                    <input type="text" class="form-control" id="vessel_name" name="vessel_name"
                                        value="{{ old('vessel_name', isset($registration) ? $registration->vessel_name : '') }}"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="vessel_type" class="form-label">Vessel Type</label>
                                    <input type="text" class="form-control" id="vessel_type" name="vessel_type"
                                        value="{{ old('vessel_type', isset($registration) ? $registration->vessel_type : '') }}"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="route" class="form-label">Route</label>
                                    <input type="text" class="form-control" id="route" name="route"
                                        value="{{ old('route', isset($registration) ? $registration->route : '') }}"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        value="{{ old('contact_number', isset($registration) ? $registration->seafarer->phone_no : '') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', isset($registration) ? $registration->seafarer->email : '') }}"
                                        >
                                </div>

                                <div class="col-md-4">
                                    <label for="referred_by" class="form-label">Referred By</label>
                                    <select name="referred_by" class="form-control" id="referred_by" >
                                        <option value="">--select--</option>
                                        @if ($agent && count($agent) > 0)
                                            @foreach ($agent as $a)
                                                <option value="{{ $a->id }}"
                                                    {{ old('referred_by', isset($registration) ? $registration->referred_by : '') == $a->id ? 'selected' : '' }}>
                                                    {{ $a->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                
                                <div class="col-md-4">
                                    <label for="signature" class="form-label">Signature Upload</label>
                                    <input type="file" class="form-control" id="signature" name="signature"
                                        accept="image/*" onchange="previewImage(this, 'signature-preview')">
                                    <div class="invalid-feedback"></div>

                                    <img id="signature-preview"
                                        src="{{ isset($registration) && $registration->signature ? asset('public/images/' . $registration->signature) : '' }}"
                                        class="img-pack"
                                        style="{{ isset($registration) && $registration->signature ? 'display: block;' : 'display: none;' }}">
                                </div>
                                @php
                                    $profilePath = '';
                                    if (isset($registration) && $registration->profile) {
                                        // Check if file exists in public/images directory
                                        $publicImagePath = public_path('images/' . $registration->profile);
                                        $storageImagePath = storage_path('app/public/profile/' . basename($registration->profile));
                                
                                        if (file_exists($publicImagePath)) {
                                            $profilePath = asset('public/images/' . $registration->profile);
                                        } elseif (file_exists($storageImagePath)) {
                                            $profilePath = asset('storage/profile/' . basename($registration->profile));
                                        }
                                    }
                                @endphp
                                <!-- Profile Upload -->
                                <!--<div class="col-md-4">-->
                                <!--    <label for="profile" class="form-label">Profile Upload</label>-->
                                <!--    <input type="file" class="form-control" id="profile" name="profile"-->
                                <!--        accept="image/*" onchange="previewImage(this, 'profile-preview')">-->
                                <!--    <div class="invalid-feedback"></div>-->

                                <!--    <img id="profile-preview"-->
                                <!--        src="{{ isset($registration) && $registration->profile ? asset('public/images/' . $registration->profile) : '' }}"-->
                                <!--        class="img-pack"-->
                                <!--        style="{{ isset($registration) && $registration->profile ? 'display: block;' : 'display: none;' }}">-->
                                <!--</div>-->
                                <div class="col-md-4">
                                    <label for="profile" class="form-label">Profile Upload</label>
                                    <input type="file" class="form-control" id="profile" name="profile"
                                        accept="image/*" onchange="previewImage(this, 'profile-preview')">
                                    <div class="invalid-feedback"></div>
                                
                                    <img id="profile-preview"
                                        src="{{ $profilePath }}"
                                        class="img-pack"
                                        style="{{ $profilePath ? 'display: block;' : 'display: none;' }}">
                                </div>



                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="ri-arrow-right-circle-line"></i></button>
                                    <button type="reset" class="btn btn-secondary"><i
                                            class="ri-restart-line"></i></button>
                                    <a href="{{ route('registrations.index') }}" class="btn btn-primary"><i
                                            class="ri-arrow-go-back-line"></i></a>
                                </div>
                            </form><!-- End Registration Form -->

                        </div>
                    </div>
                </div>
            </div>
             <div class="modal fade" id="addRankModal" tabindex="-1" aria-labelledby="addRankModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRankModalLabel">Add Rank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addRankForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="rankName" class="form-label">Rank Name</label>
                                    <input type="text" id="rankName" class="form-control" name="name" required>
                                    <span class="text-danger" id="rankError"></span>
                                </div>
                                <!-- Watchkeeper Radio Buttons -->
                                <div class="mb-3">
                                    <label class="form-label">Watchkeeper</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="watchkeeper" value="yes"
                                            required>
                                        <label class="form-check-label" for="watchkeeperYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="watchkeeper"
                                            value="no">
                                        <label class="form-check-label" for="watchkeeperNo">No</label>
                                    </div>
                                </div>

                                <!-- Food Handler Radio Buttons -->
                                <div class="mb-3">
                                    <label class="form-label">Food Handler</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="food_handler"
                                            value="yes" required>
                                        <label class="form-check-label" for="foodHandlerYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="food_handler"
                                            value="no">
                                        <label class="form-check-label" for="foodHandlerNo">No</label>
                                    </div>
                                </div>

                                <!-- Dropdown Selection -->
                                <div class="mb-3">
                                    <label for="rankCategory" class="form-label">Rank Category</label>
                                    <select id="rankCategory" class="form-control" name="category" required>
                                        <option value="">-- Select Category --</option>
                                        <option value="master">MASTER</option>
                                        <option value="rating">RATING</option>
                                        <option value="mate">MATE</option>
                                        <option value="mao_deck">MOU DECK </option>
                                        <option value="engineer">ENGINEER</option>
                                        <option value="mou_engine">MOU ENGINE </option>
                                        <option value="radio_off">RADIO OFF</option>
                                        <option value="supernumerary">SUPERNUMERARY</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" id="saveRankButton">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
    
    document.getElementById('clinic').addEventListener('change', function() {
            const clinicId = this.value;
            const doctorSelect = document.getElementById('doctor');
            doctorSelect.innerHTML = '<option value="">--select doctor--</option>';

            if (clinicId) {
                fetch(`/get-doctors/${clinicId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach(emp => {
                                const option = document.createElement('option');
                                option.value = emp.id;
                                option.textContent = emp.emp_name;

                                // If editing, preselect the saved doctor
                                if (emp.id ==
                                    "{{ isset($registration) ? $registration->employee_id : '' }}") {
                                    option.selected = true;
                                }

                                doctorSelect.appendChild(option);
                            });
                        } else {
                            doctorSelect.innerHTML = '<option value="">No doctors available</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching doctors:', error);
                        doctorSelect.innerHTML = '<option value="">Error loading doctors</option>';
                    });
            }
        });
        
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file); // Move this outside the onload function
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }




        $(document).ready(function() {
            // Function to initialize autocomplete for both indos_no and passport_no fields
            function initializeAutocomplete(selector, type) {
                $(selector).autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('ajax.get.registers') }}", // Adjust the route as necessary
                            type: "GET",
                            data: {
                                term: request.term,
                                type: type // Pass type to differentiate between indos_no and passport_no
                            },
                            dataType: "json",
                            success: function(data) {
                                response($.map(data, function(item) {
                                    // Show only indos_no or passport_no depending on the input field
                                    return {
                                        label: type === 'passport' ? item
                                            .passport_no : item.indos_no,
                                        value: type === 'passport' ? item
                                            .passport_no : item.indos_no,
                                        data: item // Pass the entire data object
                                    };
                                }));
                            },
                            error: function() {
                                // Handle error
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Autofill other fields based on selected indos_no or passport_no
                        $('#register_no').val(ui.item.data.id);
                        $('#indos_no').val(ui.item.data.indos_no);
                        $('#passport_no').val(ui.item.data.passport_no);
                        $('#cdc_no').val(ui.item.data.cdc_no);
                        $('#first_name').val(ui.item.data.seafarer.f_name);
                        $('#middle_name').val(ui.item.data.seafarer.m_name);
                        $('#last_name').val(ui.item.data.seafarer.l_name);
                        $('#dob').val(ui.item.data.seafarer.dob);
                        $('#rank').val(ui.item.data.rank_id); // Assuming rank_id is returned
                        $('#gender').val(ui.item.data.seafarer.gender); // Assuming gender is returned (1: Male, 2: Female, etc.)
                        $('#nationality').val(ui.item.data
                            .nationality_id); // Assuming nationality_id is returned
                        $('#clinic').val(ui.item.data.clinic_id); // Assuming clinic_id is returned
                        $('#company_name').val(ui.item.data.company_name);
                        $('#address').val(ui.item.data.address);
                        $('#vessel_name').val(ui.item.data.vessel_name);
                        $('#vessel_type').val(ui.item.data.vessel_type);
                        $('#route').val(ui.item.data.route);
                        $('#contact_number').val(ui.item.data.seafarer.phone_no);
                        $('#email').val(ui.item.data.seafarer.email);
                          $('#profile-preview').attr('src', "{{ asset('public/images/') }}/" + ui.item.data
                            .profile).show();
                                $('#profile').val(ui.item.data.profile);
                        $('#signature-preview').attr('src', "{{ asset('public/images/') }}/" + ui.item.data
                            .signature).show();
                                $('#signature').val(ui.item.data.signature);
                        $('#referred_by').val(ui.item.data
                            .referred_by); // Assuming referred_by agent ID is returned
                    }
                });
            }

            // Initialize autocomplete for passport_no and indos_no separately
            initializeAutocomplete('#passport_no', 'passport');
            initializeAutocomplete('#indos_no', 'indos');
        });
     $('#addRankForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let saveButton = $('#saveRankButton');
            saveButton.prop('disabled', true).text('Saving...');

            $.ajax({
                url: "{{ route('rank-store') }}", // Update with actual store route
                method: 'POST',
                data: formData, // Serialize grabs all form data
                success: function(response) {
                    $('#addRankForm')[0].reset();
                    $('#rankError').text('');
                    $('#addRankModal').modal('hide');

                    let newOption = `<option value="${response.id}" selected>${response.name}</option>`;
                    $('#rank').append(newOption).val(response.id);

                    saveButton.prop('disabled', false).text('Save');
                    $('body').append(`
                <div class="alert alert-success alert-dismissible fade show custom-alert-top" role="alert">
                    Rank added successfully
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);

                    setTimeout(function() {
                        $('.custom-alert-top').fadeOut('slow', function() {
                            $(this).remove();
                        });
                    }, 3000);
                },
                error: function(xhr) {
                    let error = xhr.responseJSON?.errors?.name ? xhr.responseJSON.errors.name[0] :
                        'An error occurred.';
                    $('#rankError').text(error);
                    saveButton.prop('disabled', false).text('Save');
                }
            });
        });
    </script>

@endsection
