@extends('layout.layout')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                @if (isset($administrator))
                                    Edit Administrator Form
                                @else
                                    New Administrator Form
                                @endif
                            </h5>

                           <form id="agentForm"
                                action="{{ isset($administrator) 
                                            ? route('administrator.update', $administrator->id) 
                                            : route('administrator.store') }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="row g-3">

                                @csrf
                                
                                @if(isset($administrator))
                                    @method('PUT')
                                @endif

                                {{-- COMPANY DROPDOWN --}}
                                <div class="col-md-4">
                                    <label for="company_id" class="form-label">Select Company</label>
                                    <select id="company_id" name="company_id" class="form-control" required>
                                        <option value="">-- Select Company --</option>

                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ old('company_id', $administrator->company_id ?? '') == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="administrator_name" class="form-label">Administrator Name</label>
                                    <input type="text" class="form-control" id="administrator_name" name="name"
                                        value="{{ old('name', $administrator->name ?? '') }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $administrator->email ?? '') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="phone_no"
                                        value="{{ old('phone_no', $administrator->phone_no ?? '') }}" required>
                                </div>
                                {{-- OPTIONAL PASSWORD --}}
                                <div class="col-md-4">
                                    <label for="password" class="form-label">Password (optional)</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter password OR leave empty for default (12345678)">
                                    <div class="invalid-feedback"></div>
                                </div>

                                {{-- <div class="col-md-4">
                                    <label for="logo" class="form-label">Administrator Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        accept="image/*" onchange="previewImage(event, 'logoPreview')">
                                    <div class="invalid-feedback"></div>

                                    @if(isset($administrator) && $administrator->logo)
                                        <img id="logoPreview" src="{{ asset('images/' . $administrator->logo) }}"
                                            class="img-fluid" style="max-width:150px; margin-top:5px; border-radius:9px;">
                                    @else
                                        <img id="logoPreview" src="" class="img-fluid"
                                            style="display:none; max-width:150px; margin-top:5px; border-radius:9px;">
                                    @endif
                                </div> --}}

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="submit-agent-form">Submit</button>
                                </div>
                            </form>

                            <div id="message" class="mt-3"></div>

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

                // Add _method if editing ADMINISTRATOR
                @if(isset($administrator))
                    formData.append('_method', 'PUT');
                @endif

                $.ajax({
                    url: "{{ isset($administrator) ? route('administrator.update', $administrator->id) : route('administrator.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.href = "{{ route('administrator.index') }}";
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
