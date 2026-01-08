@extends('layout.layout')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                
                                
                                                       
                                @if (isset($clinic))
                                    Edit Clini Form    
                                    @else
                                New Clini Form
                                @endif</h5>

                            <!-- Registration Form -->
                            <form id="agentForm" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @if (isset($clinic))
                                    @method('PUT')
                                @endif

                                <div class="col-md-4">
                                    <label for="clinic_name" class="form-label">Clinic Name</label>
                                    <input type="text"
                                        class="form-control" id="clinic_name" name="clinic_name"
                                        value="{{ old('clinic_name', isset($clinic) ? $clinic->name : '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                        <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', isset($clinic) ? $clinic->email : '') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="phone"
                                        value="{{ old('phone', isset($clinic) ? $clinic->phone : '') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text"
                                        class="form-control" id="address" name="address"
                                        value="{{ old('address', isset($clinic) ? $clinic->address : '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="branch" class="form-label">Branch</label>
                                      <input type="text"
                                        class="form-control" id="branch" name="branch"
                                        value="{{ old('branch', isset($clinic) ? $clinic->branch : '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="logo" class="form-label">Clinic Logo</label>
                                    <input type="file"
                                        class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, 'logoPreview')">
                                    <div class="invalid-feedback"></div>

                                    <img id="logoPreview"
                                        src="{{ isset($clinic) && $clinic->logo ? asset('images/' . $clinic->logo) : '' }}"
                                        alt="Logo Preview" class="img-fluid"
                                        style="display: {{ isset($clinic) ? 'block' : 'none' }}; max-width: 150px; margin-top:5px;  border-radius: 9px;">

                                </div>

                                <div class="col-md-4">
                                    <label for="stamp" class="form-label">Stamp Upload</label>
                                    <input type="file"
                                        class="form-control" id="stamp" name="stamp" accept="image/*" onchange="previewImage(event, 'stampPreview')">
                                    <div class="invalid-feedback"></div>

                                   <img id="stampPreview"
                                        src="{{ isset($clinic) && $clinic->stamp ? asset('images/' . $clinic->stamp) : '' }}"
                                        alt="Stamp Preview" class="img-fluid"
                                        style="display: {{ isset($clinic) ? 'block' : 'none' }}; max-width: 150px; margin-top:5px; border-radius: 9px;">

                                </div>

                                
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="submit-agent-form"><i
                                            class="ri-arrow-right-circle-line"></i></button>
                                    <button type="reset" class="btn btn-secondary"><i
                                            class="ri-restart-line"></i></button>
                                    <a href="{{ route('clinics.index') }}" class="btn btn-primary"><i
                                            class="ri-arrow-go-back-line"></i></a>
                                </div>
                            </form><!-- Registration Form -->

                            <div id="message" class="mt-3"></div> <!-- Message Container -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function previewImage(event, previewId) {
            const input = event.target;
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
            $('#submit-agent-form').click(function(e) {
                e.preventDefault(); // Prevent the default button behavior

                // Clear previous error messages
                $('.invalid-feedback').text('');
                $('.is-invalid').removeClass('is-invalid');

                // Create a FormData object to handle file uploads
                var formData = new FormData($('#agentForm')[0]);

                // AJAX request
                $.ajax({
                    url: "{{ isset($clinic) ? route('clinics.update', $clinic->id) : route('clinics.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false, // Necessary for file uploads
                    processData: false, // Necessary for file uploads
                    success: function(response) {
                        alert('Clinic saved successfully.');
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            // Validation errors from the server (Laravel validation)
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid'); // Highlight the field with error
                                $('#' + key).next('.invalid-feedback').text(value[0]); // Show error message
                            });
                        } else {
                            $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
