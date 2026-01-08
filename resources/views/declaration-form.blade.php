@extends('layout.minimal')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 900px; border: none;">
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('public/assets/img/logo.png') }}" alt="Logo" class="me-3" style="height: 50px;">
                            <h2 class="m-0 text-primary">Medical Declaration</h2>
                        </div>
                        <p class="text-muted">Please complete all medical test declarations</p>
                    </div>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('qr.declaration.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="reg_token" value="{{ session('reg_token') }}">
                        <input type="hidden" name="category_id" value="{{ $categoryId ?? '1' }}"> 

                        <div class="mb-4 p-4 rounded" style="background-color: #f8f9fa; border: 1px solid #e3f2fd;">
                            <div class="medical-declaration row">
                                @foreach($tests as $test)
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label d-block mb-1">{{ $test->name }}</label>
                        
                                        @if($test->field_type == 'dropdown')
                                            @php
                                                $options = json_decode($test->dropdown_values, true);
                                                $selectedValue = $medicalDeclaration[$test->id] ?? ($options[0] ?? '');
                                            @endphp
                        
                                            <select name="medical_declaration[{{ $test->id }}]" class="form-select">
                                                @foreach($options as $option)
                                                    <option value="{{ $option }}" {{ $selectedValue == $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" 
                                                   name="medical_declaration[{{ $test->id }}]" 
                                                   class="form-control" 
                                                   value="{{ $medicalDeclaration[$test->id] ?? ($test->text_value ?? '') }}">    
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('qr.registration.form') }}" class="btn btn-outline-secondary">
                                Back to Registration
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Save and Continue
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
        .form-control, .form-select {
            background-color: #f5f5f5;
            border: 1px solid #cfd8dc;
        }
        .form-control:focus, .form-select:focus {
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
        .btn-outline-secondary {
            border-color: #cfd8dc;
            color: #455a64;
        }
        .btn-outline-secondary:hover {
            background-color: #f5f5f5;
        }
        .text-primary {
            color: #0288d1 !important;
        }
        .medical-declaration {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 10px;
        }
        .medical-declaration::-webkit-scrollbar {
            width: 8px;
        }
        .medical-declaration::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .medical-declaration::-webkit-scrollbar-thumb {
            background: #0288d1;
            border-radius: 10px;
        }
        .medical-declaration::-webkit-scrollbar-thumb:hover {
            background: #0277bd;
        }
    </style>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if there's an error message about missing registration data
                @if(session('error') && str_contains(session('error'), 'complete the registration form'))
                    // Clear the session data that might be causing the loop
                    fetch('{{ route("clear.registration.session") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(() => {
                        window.location.href = '{{ route("qr.registration.form") }}';
                    });
                @endif
            });
        </script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection