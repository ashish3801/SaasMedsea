@extends('layout.layout')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@if(isset($agent))
                           Edit Agent Form
                            @else
                            
                           New Agent Form
                            @endif
                            
                            </h5>

                            <!-- Registration Form -->
                            <div id="agent-form" class="row g-3">
                                @csrf
                                @if (isset($agent))
                                    @method('PUT')
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="z-index: 1050;">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', isset($agent) ? $agent->name : '') }}" >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>

                               <div class="col-md-4">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company_name"value="{{ $company->name }}" 
                                        readonly>

                                    <!-- Hidden field to pass company_id -->
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                </div>


                                <div class="col-md-4">
                                    <label for="phone_no" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no"
                                        value="{{ old('phone_no', isset($agent) ? $agent->phone_no : '') }}" >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone_no') }}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', isset($agent) ? $agent->email : '') }}" >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>

                                
                                
                                <div class="text-center">
                                                        <button type="button" id="submit-agent-form" class="btn btn-primary"><i class="ri-arrow-right-circle-line"></i></button>
                                    <button type="reset" class="btn btn-secondary"><i
                                            class="ri-restart-line"></i></button>
                                    <a href="{{ route('agents.index') }}" class="btn btn-primary"><i
                                            class="ri-arrow-go-back-line"></i></a>
                                </div>
                            </div><!-- Registration Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        $(document).ready(function() {
            $('#submit-agent-form').click(function(e) {
                e.preventDefault(); // Prevent default button behavior

                // Clear previous error messages
                $('.invalid-feedback').text('');
                $('.is-invalid').removeClass('is-invalid');

                // Collect form data
                var formData = {
                    name: $('#name').val(),
                    company_id: $('#company_id').val(),
                    phone_no: $('#phone_no').val(),
                    email: $('#email').val(),
                    _token: "{{ csrf_token() }}", // CSRF token
                    @if (isset($agent))
                        _method: 'PUT' // Include method override for updates
                    @endif
                };

                // AJAX request
                $.ajax({
                    url: "{{ isset($agent) ? route('agents.update', $agent->id) : route('agents.store') }}", // Dynamic URL
                    type: 'POST', // Always POST
                    data: formData, // Send data
                    success: function(response) {
                        // Success message or redirect
                        alert('Agent saved successfully');
                        // window.location.href = "{{ route('agents.create') }}"; // Redirect to create page
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            // Validation errors from the server (Laravel validation)
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid'); // Highlight field with error
                                $('#' + key).next('.invalid-feedback').text(value[0]); // Show error message
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
