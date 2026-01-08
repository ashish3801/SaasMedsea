@extends('layout.minimal')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session()->has('qr_registration_id'))
                    <div class="alert alert-info">
                        You have an existing registration in progress. 
                        <a href="{{ route('qr.registration.form') }}" class="alert-link">
                            Click here to start a new registration instead.
                        </a>
                    </div>
                @endif
                <div class="card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 900px; border: none;">
                    <!-- Header with Logo -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('public/assets/img/logo.png') }}" alt="MedSea Logo" class="me-3" style="height: 50px;">
                            <h2 class="m-0 text-primary">Seafarer Registration</h2>
                        </div>
                    </div>

                  <form method="POST" action="{{ route('qr.registration.store') }}" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Validation Errors:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        {{-- <input type="hidden" id="register_no" name="register_no" value="{{ $registration->id ?? ($formData['register_no'] ?? '') }}"> --}}
                        <input type="hidden" name="reg_token" value="{{ session('reg_token') }}">

                        <!-- Section 1: Identification -->
                        <div class="col-12">
                            <h6 class="border-bottom pb-2 mb-3 text-primary">
                                <i class="bi bi-person-badge-fill me-2"></i>Identification Details
                            </h6>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="indos_no" class="form-label">Indos No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="indos_no" name="indos_no" 
                                   value="{{ old('indos_no', $formData['indos_no'] ?? '') }}" required>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="passport_no" class="form-label">Passport No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="passport_no" name="passport_no" 
                                   value="{{ old('passport_no', $formData['passport_no'] ?? '') }}" required>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="cdc_no" class="form-label">CDC No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cdc_no" name="cdc_no" 
                                   value="{{ old('cdc_no', $formData['cdc_no'] ?? '') }}" required>
                        </div>
                    
                        <!-- Section 2: Personal Information -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-primary">
                                <i class="bi bi-person-lines-fill me-2"></i>Personal Information
                            </h6>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name', $formData['first_name'] ?? (isset($registration) ? $registration->seafarer->f_name : '')) }}"
                                required>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name"
                                   value="{{ old('middle_name', $formData['middle_name'] ?? '') }}">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{ old('last_name', $formData['last_name'] ?? '') }}" required>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                   value="{{ old('dob', $formData['dob'] ?? '') }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="pob" class="form-label">Place of Birth</label>
                            <input type="text" class="form-control" id="pob" name="pob"
                                   value="{{ old('pob', $formData['pob'] ?? '') }}">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="sex" class="form-label">Sex</label>
                            <select name="sex" class="form-select" id="sex">
                                <option value="1" {{ (old('sex', $formData['sex'] ?? '') == '1') ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ (old('sex', $formData['sex'] ?? '') == '2') ? 'selected' : '' }}>Female</option>
                                <option value="3" {{ (old('sex', $formData['sex'] ?? '') == '3') ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="nationality" class="form-label">Nationality</label>
                            <select name="nationality" class="form-select select2" id="nationality">
                                <option value="">-- Select Nationality --</option>
                                @foreach ($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}"
                                        {{ (old('nationality', $formData['nationality'] ?? (isset($registration) ? $registration->nationality_id : '')) == $nationality->id) ? 'selected' : '' }}>
                                        {{ $nationality->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number"
                                   value="{{ old('contact_number', $formData['contact_number'] ?? '') }}" required>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', $formData['email'] ?? '') }}">
                        </div>
                    
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $formData['address'] ?? (isset($registration) ? $registration->address : '')) }}">
                        </div>
                    
                        <!-- Section 3: Professional Information -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-primary">
                                <i class="bi bi-briefcase-fill me-2"></i>Professional Information
                            </h6>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="rank" class="form-label">Rank <span class="text-danger">*</span></label>
                            <select name="rank" class="form-select select2" id="rank" required>
                                <option value="">-- Select Rank --</option>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->id }}"
                                        {{ (old('rank', $formData['rank'] ?? (isset($registration) ? $registration->rank_id : '')) == $rank->id) ? 'selected' : '' }}>
                                        {{ $rank->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ old('company_name', $formData['company_name'] ?? (isset($registration) ? $registration->company_name : '')) }}">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="vessel_name" class="form-label">Vessel Name</label>
                            <input type="text" class="form-control" id="vessel_name" name="vessel_name"
                                   value="{{ old('vessel_name', $formData['vessel_name'] ?? '') }}">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="vessel_type" class="form-label">Vessel Type</label>
                            <input type="text" class="form-control" id="vessel_type" name="vessel_type"
                                   value="{{ old('vessel_type', $formData['vessel_type'] ?? '') }}">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="route" class="form-label">Route</label>
                            <input type="text" class="form-control" id="route" name="route"
                                   value="{{ old('route', $formData['route'] ?? '') }}">
                        </div>
                    
                        <!-- Section 4: Medical Information -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-primary">
                                <i class="bi bi-heart-pulse-fill me-2"></i>Medical Information
                            </h6>
                        </div>
                    
                        <!--<div class="col-md-4">-->
                        <!--    <label for="package_id" class="form-label">Package <span class="text-danger">*</span></label>-->
                        <!--    <select name="package_id" class="form-select select2" id="package_id" required>-->
                        <!--        <option value="">-- Select Package --</option>-->
                        <!--        @foreach ($packages as $package)-->
                        <!--            <option value="{{ $package->id }}"-->
                        <!--                {{ (old('package_id', $formData['package_id'] ?? (isset($registration) ? $registration->package_id : '')) == $package->id) ? 'selected' : '' }}>-->
                        <!--                {{ $package->name }}-->
                        <!--            </option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->
                        <div class="col-md-4">
                            <label for="package_ids" class="form-label">Packages <span class="text-danger">*</span></label>
                            <select name="package_ids[]" id="package_ids" class="form-control select2" multiple="multiple" required>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}"
                                        @if(old('package_ids'))
                                            {{ in_array($package->id, old('package_ids')) ? 'selected' : '' }}
                                        @elseif(isset($formData['package_ids']))
                                            {{ in_array($package->id, $formData['package_ids']) ? 'selected' : '' }}
                                        @endif>
                                        {{ $package->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('package_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <div class="col-md-4">
                            <label for="referred_by" class="form-label">Referred By</label>
                            <select name="referred_by" class="form-select select2" id="referred_by">
                                <option value="">-- Select Agent --</option>
                                @foreach ($agent as $a)
                                    <option value="{{ $a->id }}"
                                        {{ (old('referred_by', $formData['referred_by'] ?? '') == $a->id) ? 'selected' : '' }}>
                                        {{ $a->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Section 5: Documents -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-primary">
                                <i class="bi bi-file-earmark-fill me-2"></i>Documents
                            </h6>
                        </div>
                    
                        <div class="col-md-6">
                            <label class="form-label">Signature</label>
                            
                           
                            <div class="btn-group btn-group-sm mb-3 w-100" role="group">
                                <button type="button" class="btn btn-outline-primary active" id="upload-toggle">
                                    <i class="bi bi-upload"></i> Upload Signature
                                </button>
                                <button type="button" class="btn btn-outline-primary" id="draw-toggle">
                                    <i class="bi bi-pencil"></i> Draw Signature
                                </button>
                            </div>
                         
                            <div id="upload-section">
                                <div class="input-group mb-2">
                                    <input type="file" class="form-control" id="signature-upload" name="signature" accept="image/*">
                                </div>
                                <div class="text-muted small mb-3">Accepted formats: JPG, PNG (max 2MB)</div>
                            </div>
                            
                            <!-- Canvas Section (hidden by default) -->
                            <div id="canvas-section" style="display: none;">
                                <div class="border rounded p-2 mb-2 bg-light">
                                    <canvas id="signature-pad" width="400" height="200"></canvas>
                                </div>
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" id="clear-signature" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-eraser"></i> Clear
                                    </button>
                                    <button type="button" id="save-signature" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-save"></i> Save Drawing
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Hidden input to store the final signature -->
                            <input type="hidden" id="signature-data" name="signature">
                            
                            <!-- Preview Section -->
                            <div class="mt-3 border-top pt-3">
                                <h6 class="small text-muted mb-2">Signature Preview:</h6>
                                <div id="signature-preview" class="text-center">
                                    @if(isset($formData['signature']))
                                        <img src="{{ asset('storage/'.$formData['signature']) }}" 
                                             class="img-fluid border" style="max-height: 80px;">
                                    @else
                                        <div class="py-4 bg-light rounded">
                                            <i class="bi bi-signature display-5 text-muted"></i>
                                            <p class="small text-muted mt-2">No signature provided</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                        <!--<div class="col-md-6">-->
                        <!--    <label for="profile" class="form-label">Profile Photo</label>-->
                        <!--    <div class="input-group">-->
                        <!--        <input type="file" class="form-control" id="profile" name="profile"-->
                        <!--            accept="image/*" onchange="previewImage(this, 'profile-preview')">-->
                        <!--    </div>-->
                        <!--    <div class="mt-2">-->
                        <!--        @if(isset($formData['profile']))-->
                        <!--            <img id="profile-preview" src="{{ asset('storage/'.$formData['profile']) }}" -->
                        <!--                 class="img-thumbnail rounded-circle" style="max-height: 150px; max-width: 150px; display: block;">-->
                        <!--        @else-->
                        <!--            <img id="profile-preview" src="https://via.placeholder.com/300x300?text=Photo+Preview"-->
                        <!--                 class="img-thumbnail rounded-circle" style="max-height: 150px; max-width: 150px; display: none;">-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="col-md-6">
                            <label for="profile" class="form-label">Profile Photo</label>
                            
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" id="profile" name="profile" accept="image/*"
                                    onchange="previewImage(this, 'profile-preview')">
                            </div>

                            <!-- Webcam preview and capture -->
                            <button type="button" class="btn btn-primary mb-2" onclick="startCamera()">Use Webcam</button>
                            <video id="webcam" width="300" height="225" autoplay style="display:none;"></video>
                            <canvas id="canvas" width="300" height="225" style="display:none;"></canvas>
                            <button type="button" class="btn btn-success mt-1" onclick="captureImage()" style="display:none;" id="captureBtn">Capture Photo</button>

                            <input type="hidden" id="webcamImage" name="webcam_image">

                            <div class="mt-2">
                                <img id="profile-preview"
                                    src="{{ isset($formData['profile']) ? asset('storage/' . $formData['profile']) : 'https://via.placeholder.com/300x300?text=Photo+Preview' }}"
                                    class="img-thumbnail rounded-circle"
                                    style="max-height: 150px; max-width: 150px; {{ isset($formData['profile']) ? 'display: block;' : 'display: none;' }}">
                            </div>
                        </div>
                    
                        <!-- Form Submission -->
                        <!--<div class="col-12 mt-4">-->
                        <!--    <button type="submit" class="btn btn-primary w-100">-->
                        <!--        <i class="bi bi-save-fill me-1"></i> Submit-->
                        <!--    </button>-->
                        <!--</div>-->
                        <div class="col-12 mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-md">
                                <i class="bi bi-save-fill me-1"></i> Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 50%, #80deea 100%);
            min-height: 100vh;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 500;
            color: #455a64;
        }
        .img-thumbnail {
            border: 1px dashed #b0bec5;
            padding: 0.25rem;
            background-color: #f8f9fa;
        }
        .border-bottom {
            border-color: #e3f2fd !important;
        }
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 0.375rem 0.75rem;
            border: 1px solid #cfd8dc !important;
            border-radius: 0.375rem !important;
            background-color: #f5f5f5;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5rem;
            color: #455a64;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .rounded-4 {
            border-radius: 1rem !important;
        }
        .btn-primary {
            background-color: #0288d1;
            border-color: #0288d1;
        }
        .btn-primary:hover {
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .text-primary {
            color: #0288d1 !important;
        }
        input.form-control, select.form-select {
            background-color: #f5f5f5;
            border: 1px solid #cfd8dc;
        }
        input.form-control:focus, select.form-select:focus {
            background-color: #fff;
            border-color: #0288d1;
            box-shadow: 0 0 0 0.25rem rgba(2, 136, 209, 0.25);
        }
        .alert {
            border-radius: 8px;
        }
        .ui-autocomplete {
            position: absolute;
            z-index: 1000;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .ui-autocomplete .ui-menu-item {
            padding: 8px 15px;
            border-bottom: 1px solid #eee;
        }
        .ui-autocomplete .ui-menu-item:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
        .ui-helper-hidden-accessible {
            display: none;
        }
    </style>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI for autocomplete -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const uploadToggle = document.getElementById('upload-toggle');
    const drawToggle = document.getElementById('draw-toggle');
    const uploadSection = document.getElementById('upload-section');
    const canvasSection = document.getElementById('canvas-section');
    const signatureUpload = document.getElementById('signature-upload');
    const previewDiv = document.getElementById('signature-preview');
    
    // Initialize signature pad
    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)',
        minWidth: 1,
        maxWidth: 2,
        throttle: 16 // Add smoother drawing on mobile
    });
    
    // Set fixed dimensions for the canvas container
    const canvasContainer = canvas.parentElement;
    canvasContainer.style.width = '100%';
    canvasContainer.style.height = '200px';
    canvasContainer.style.maxWidth = '400px';
    canvasContainer.style.margin = '0 auto';
    
    // Toggle between upload and draw
    uploadToggle.addEventListener('click', function() {
        this.classList.add('active');
        drawToggle.classList.remove('active');
        uploadSection.style.display = 'block';
        canvasSection.style.display = 'none';
    });
    
    drawToggle.addEventListener('click', function() {
        this.classList.add('active');
        uploadToggle.classList.remove('active');
        uploadSection.style.display = 'none';
        canvasSection.style.display = 'block';
        resizeCanvas();
    });
    
    // Handle file upload
    signatureUpload.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Display preview
                previewDiv.innerHTML = `<img src="${event.target.result}" class="img-fluid border" style="max-height: 80px;">`;
                
                // Store as base64 in hidden input
                document.getElementById('signature-data').value = event.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Canvas functions
    function resizeCanvas() {
        const container = canvas.parentElement;
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        
        // Set canvas dimensions based on container
        canvas.width = container.offsetWidth * ratio;
        canvas.height = container.offsetHeight * ratio;
        canvas.style.width = container.offsetWidth + 'px';
        canvas.style.height = container.offsetHeight + 'px';
        
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad.clear();
    }
    
    // Initial resize
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    
    // Prevent scrolling when drawing on mobile
    canvas.addEventListener('touchstart', function(e) {
        if (e.target === canvas) {
            e.preventDefault();
        }
    }, { passive: false });
    
    canvas.addEventListener('touchmove', function(e) {
        if (e.target === canvas) {
            e.preventDefault();
        }
    }, { passive: false });
    
    document.getElementById('clear-signature').addEventListener('click', function() {
        signaturePad.clear();
    });
    
    document.getElementById('save-signature').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            alert('Please provide a signature first.');
            return;
        }
        
        const signatureData = signaturePad.toDataURL('image/png');
        document.getElementById('signature-data').value = signatureData;
        
        // Show preview
        previewDiv.innerHTML = `<img src="${signatureData}" class="img-fluid border" style="max-height: 80px;">`;
        
        // Switch back to upload view
        uploadToggle.click();
    });
});
</script>
    <script>
        
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
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
                            url: "{{ route('ajax.get.registers') }}",
                            type: "GET",
                            data: {
                                term: request.term,
                                type: type
                            },
                            dataType: "json",
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: type === 'passport' ? item.passport_no : item.indos_no,
                                        value: type === 'passport' ? item.passport_no : item.indos_no,
                                        data: item
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
                        $('#rank').val(ui.item.data.rank_id).trigger('change');
                        $('#sex').val(ui.item.data.seafarer.sex);
                        $('#nationality').val(ui.item.data.nationality_id).trigger('change');
                        $('#clinic').val(ui.item.data.clinic_id).trigger('change');
                        $('#company_name').val(ui.item.data.company_name);
                        $('#address').val(ui.item.data.address);
                        $('#vessel_name').val(ui.item.data.vessel_name);
                        $('#vessel_type').val(ui.item.data.vessel_type);
                        $('#route').val(ui.item.data.route);
                        $('#contact_number').val(ui.item.data.seafarer.phone_no);
                        $('#email').val(ui.item.data.seafarer.email);
                        $('#profile-preview').attr('src', "{{ asset('public/images/') }}/" + ui.item.data.profile).show();
                        $('#signature-preview').attr('src', "{{ asset('public/images/') }}/" + ui.item.data.signature).show();
                        $('#referred_by').val(ui.item.data.referred_by).trigger('change');
                    },
                    minLength: 2 // Minimum characters before triggering autocomplete
                });
            }

            // Initialize autocomplete for passport_no and indos_no separately
            initializeAutocomplete('#passport_no', 'passport');
            initializeAutocomplete('#indos_no', 'indos');
            
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            }).on('select2:open', function(e) {
                $('.select2-search__field').addClass('form-control');
            });
        });

        $('#addRankForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let saveButton = $('#saveRankButton');
            saveButton.prop('disabled', true).text('Saving...');

            $.ajax({
                url: "{{ route('rank-store') }}",
                method: 'POST',
                data: formData,
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
    <script>
        let webcamStream;

        function startCamera() {
            const video = document.getElementById('webcam');
            const captureBtn = document.getElementById('captureBtn');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    webcamStream = stream;
                    video.srcObject = stream;
                    video.style.display = 'block';
                    captureBtn.style.display = 'inline-block';
                })
                .catch(function (err) {
                    alert("Webcam access denied or not available.");
                    console.error(err);
                });
        }

        function captureImage() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            const preview = document.getElementById('profile-preview');
            const webcamInput = document.getElementById('webcamImage');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/jpeg'); // base64 image

            preview.src = imageData;
            preview.style.display = 'block';
            webcamInput.value = imageData;

            // stop the webcam
            video.srcObject.getTracks().forEach(track => track.stop());
            video.style.display = 'none';
            document.getElementById('captureBtn').style.display = 'none';
        }

        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection