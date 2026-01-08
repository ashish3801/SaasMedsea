@extends('layout.layout')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">                                
                                @if (isset($employee))
                                 Edit  Employee
                                    @else
                                 Create Employee 
                                @endif</h5>

                            <!-- Employee Form -->
                            <form id="employee-form" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @if (isset($employee))
                                    @method('PUT')
                                @endif

                                <!-- Employee Rank -->
                                <div class="col-md-4">
                                    <label for="rank" class="form-label">Employee Rank</label>
                                    <input type="text" class="form-control" id="rank" name="rank"
                                        value="{{ old('rank', isset($employee) ? $employee->emp_id : '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Employee Name -->
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Employee Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', isset($employee) ? $employee->emp_name : '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Contact Number -->
                                <div class="col-md-4">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        value="{{ old('contact_number', isset($employee) ? $employee->phone_no : '') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', isset($employee) ? $employee->email : '') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- DGS Approval Number -->
                                <div class="col-md-4">
                                    <label for="dgs_approval_no" class="form-label">DGS Approval Number</label>
                                    <input type="text" class="form-control" id="dgs_approval_no" name="dgs_approval_no"
                                        value="{{ old('dgs_approval_no', isset($employee) ? $employee->dgs_approval_number : '') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Certificate Issued By -->
                                <div class="col-md-4">
                                    <label for="certificate_issued_by" class="form-label">Certificate Issued By</label>
                                    <input type="text" class="form-control" id="certificate_issued_by"
                                        name="certificate_issued_by"
                                        value="{{ old('certificate_issued_by', isset($employee) ? $employee->certificate_issued_by : '') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Certificate Issue Date -->
                                <div class="col-md-4">
                                    <label for="certificate_issue_date" class="form-label">Certificate Issue Date</label>
                                    <input type="date" class="form-control" id="certificate_issue_date"
                                        name="certificate_issue_date"
                                        value="{{ old('certificate_issue_date', isset($employee) ? $employee->certificate_issue_date : '') }}">
                                    <div class="invalid-feedback"></div>
                                </div>


                                <div class="col-md-4">
                                    <label for="clinic" class="form-label">Clinic</label>
                                    <select name="clinic" class="form-control" id="clinic" required>
                                        <option value="">--select--</option>
                                        @if ($clinic && count($clinic) > 0)
                                            @foreach ($clinic as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ old('clinic', isset($employee) ? $employee->clinic_id : '') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">No clinic available. Please add one.</option>
                                        @endif
                                    </select>
                                </div>
                                <!-- Signature Upload -->

                                <div class="col-md-4">
                                    <label for="signature" class="form-label">Signature Upload</label>
                                    <input type="file" class="form-control" id="signature" name="signature"
                                        accept="image/*" onchange="previewImage(this, 'signature-preview')">
                                    <div class="invalid-feedback"></div>
                                    <img id="signature-preview"
                                        src="{{ isset($employee) && $employee->sign_upload ? asset('images/' . $employee->sign_upload) : '' }}"
                                        style="max-width: 150px; margin-top: 10px; {{ isset($employee) && $employee->sign_upload ? '' : 'display: none;' }}">
                                        
                                        
                                </div>

                                <!-- Stamp Upload -->
                                <div class="col-md-4">
                                    <label for="stamp" class="form-label">Stamp Upload</label>
                                    <input type="file" class="form-control" id="stamp" name="stamp"
                                        accept="image/*" onchange="previewImage(this, 'stamp-preview')">
                                    <div class="invalid-feedback"></div>
                                    <img id="stamp-preview"
                                    src="{{ isset($employee) && $employee->stamp_upload ? asset('images/' . $employee->stamp_upload) : '' }}"
                                    style="max-width: 150px; margin-top: 10px; {{ isset($employee) && $employee->stamp_upload ? '' : 'display: none;' }}">

                                </div>



                                 
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="submit-employee-form"><i
                                            class="ri-arrow-right-circle-line"></i></button>
                                    <button type="reset" class="btn btn-secondary"><i
                                            class="ri-restart-line"></i></button>
                                    <a href="{{ route('employees.index') }}" class="btn btn-primary"><i
                                            class="ri-arrow-go-back-line"></i></a>
                                </div>
                            </form><!-- Employee Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }

        $(document).ready(function() {
            $('#submit-employee-form').click(function(e) {
                e.preventDefault(); // Prevent the default button behavior

                // Clear previous error messages
                $('.invalid-feedback').text('');
                $('.is-invalid').removeClass('is-invalid');

                // Create a FormData object to handle file uploads
                var formData = new FormData($('#employee-form')[0]);

                // AJAX request
                $.ajax({
                    url: "{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false, // Necessary for file uploads
                    processData: false, // Necessary for file uploads
                    success: function(response) {
                        alert('Employee saved successfully.');
                        // window.location.href = "{{ route('employees.create') }}"; // Redirect on success
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            // Validation errors from the server (Laravel validation)
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass(
                                    'is-invalid'); // Highlight the field with error
                                $('#' + key).next('.invalid-feedback').text(value[
                                    0]); // Show error message
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
