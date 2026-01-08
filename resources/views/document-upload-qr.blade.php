@extends('layout.minimal')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 900px; border: none;">
                    <!-- Header with Logo -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('public/assets/img/logo.png') }}" alt="MedSea Logo" class="me-3" style="height: 50px;">
                            <h2 class="m-0 text-primary">Upload Required Documents</h2>
                        </div>
                        <p class="text-muted">Please upload all required documents to complete your registration</p>
                    </div>

                    <!-- Error/Success Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="documentForm" method="POST" action="{{ route('qr.documents.store') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="register_no" value="{{ is_array(session('qr_registration_id')) ? '' : session('qr_registration_id') }}"> --}}
                         <input type="hidden" name="reg_token" value="{{ $token }}">

                        <!-- Documents Upload Section -->
                        <div class="mb-4 p-4 rounded" style="background-color: #f8f9fa; border: 1px solid #e3f2fd;">
                            <div class="row">
                                <!-- Medical Certificate -->
                                <div class="col-md-6 mb-4">
                                    <label for="medical_certificate" class="form-label">Medical Certificate <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="file" name="medical_certificate" id="medical_certificate" class="form-control" required>
                                    </div>
                                    <div class="mt-2">
                                        <div class="file-preview" id="medical-certificate-preview" style="display: none;">
                                            <i class="bi bi-file-earmark-pdf" style="font-size: 2rem;"></i>
                                            <span class="file-name d-block mt-2"></span>
                                        </div>
                                        <small class="text-muted">Accepted formats: PDF, JPG, JPEG, PNG (Max 2MB)</small>
                                    </div>
                                </div>
                    
                                <!-- ID Proof -->
                                <div class="col-md-6 mb-4">
                                    <label for="id_proof" class="form-label">Passport<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="file" name="id_proof" id="id_proof" class="form-control" required>
                                    </div>
                                    <div class="mt-2">
                                        <div class="file-preview" id="id-proof-preview" style="display: none;">
                                            <i class="bi bi-file-earmark-image" style="font-size: 2rem;"></i>
                                            <span class="file-name d-block mt-2"></span>
                                        </div>
                                        <small class="text-muted">Accepted formats: PDF, JPG, JPEG, PNG (Max 2MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('qr.declaration.form') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-save-fill me-1"></i> Submit Registration
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
        .form-control {
            background-color: #f5f5f5;
            border: 1px solid #cfd8dc;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #0288d1;
            box-shadow: 0 0 0 0.25rem rgba(2, 136, 209, 0.25);
        }
        .btn-primary {
            background-color: #0288d1;
            border-color: #0288d1;
        }
        .btn-primary:hover {
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .file-preview {
            background-color: #fff;
            border: 1px dashed #b0bec5;
            padding: 1rem;
            text-align: center;
            border-radius: 8px;
        }
        .file-preview i {
            color: #0288d1;
        }
    </style>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File preview handlers
            const setupFilePreview = (inputId, previewId, defaultIconClass) => {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        preview.style.display = 'block';
                        preview.querySelector('.file-name').textContent = file.name;
                        
                        // Update icon based on file type
                        const icon = preview.querySelector('i');
                        if (file.type.includes('pdf')) {
                            icon.className = 'bi bi-file-earmark-pdf';
                        } else if (file.type.includes('image')) {
                            icon.className = 'bi bi-file-earmark-image';
                        } else {
                            icon.className = defaultIconClass;
                        }
                    } else {
                        preview.style.display = 'none';
                    }
                });
            };

            // Initialize previews
            setupFilePreview('medical_certificate', 'medical-certificate-preview', 'bi bi-file-earmark-pdf');
            setupFilePreview('id_proof', 'id-proof-preview', 'bi bi-file-earmark-image');

            // Form submission handler
            document.getElementById('documentForm').addEventListener('submit', function(e) {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-1"></i> Processing...';
            });
        });
    </script>
@endsection