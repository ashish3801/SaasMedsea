@extends('layout.layout')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> 
                                @if (isset($company))
                                    Edit Company Form    
                                    @else
                                New Company Form
                                @endif</h5>

                            <!-- Registration Form -->
                            <form id="agentForm" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @if (isset($company))
                                    @method('PUT')
                                @endif

                                <div class="col-md-4">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text"
                                        class="form-control" id="company_name" name="name"
                                        value="{{ old('name', isset($company) ? $company->name : '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                        <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', isset($company) ? $company->email : '') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                        value="{{ old('contact', isset($company) ? $company->contact : '') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea
                                        class="form-control" id="address" name="address"
                                        required>{{ old('address', isset($company) ? $company->address : '') }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="logo" class="form-label">Company Logo</label>
                                    <input type="file"
                                        class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, 'logoPreview')">
                                    <div class="invalid-feedback"></div>

                                    @if(isset($company) && $company->logo)
                                        <img id="logoPreview" src="{{ asset('images/' . $company->logo) }}" alt="Logo Preview"
                                            class="img-fluid" style="max-width:150px; margin-top:5px; border-radius:9px;">
                                    @else
                                        <img id="logoPreview" src="" alt="Logo Preview" class="img-fluid" style="display:none; max-width:150px; margin-top:5px; border-radius:9px;">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-control" id="is_active" name="is_active" required>
                                        <option value="1" {{ old('is_active', isset($company) ? $company->is_active : '') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', isset($company) ? $company->is_active : '') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="submit-agent-form">Submit</button>
                                  
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
                e.preventDefault();

                $('.invalid-feedback').text('');
                $('.is-invalid').removeClass('is-invalid');

                var formData = new FormData($('#agentForm')[0]);

                // Add _method if editing
                @if(isset($company))
                    formData.append('_method', 'PUT');
                @endif

                $.ajax({
                    url: "{{ isset($company) ? route('company.update', $company->id) : route('company.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Redirect to index after save/update
                        window.location.href = "{{ route('company.index') }}";
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).next('.invalid-feedback').text(value[0]);
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
