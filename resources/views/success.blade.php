@extends('layout.minimal')
@section('content')
    <div class="success-page" style="background: linear-gradient(135deg, #e0f3f8 0%, #a8e6f0 100%); min-height: 100vh; width: 100%;">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <!-- Left decorative column - Medical/Sea Theme -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="success-illustration" style="
                        height: 100vh;
                        background: url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover;
                        position: relative;
                    ">
                        <div style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: rgba(0, 119, 182, 0.3);
                        "></div>
                        <div style="
                            position: absolute;
                            bottom: 30px;
                            left: 30px;
                            color: white;
                            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
                        ">
                            <h3 style="font-weight: 600;">Medical Care With Compassion</h3>
                            <p class="mb-0">Where the sea meets healthcare excellence</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right content column -->
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="p-5" style="max-width: 600px; margin: 0 auto;">
                        <div class="text-center mb-5">
                            <div style="
                                background-color: #e1f5fe;
                                width: 120px;
                                height: 120px;
                                border-radius: 50%;
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                margin-bottom: 2rem;
                                box-shadow: 0 4px 20px rgba(0, 150, 199, 0.2);
                                border: 3px solid #4fc3f7;
                            ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#0288d1" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </div>
                            
                            <h1 class="display-5 fw-bold mb-3" style="color: #0077b6;">Registration Successful!</h1>
                            
                            <p class="lead mb-4" style="color: #424242; font-size: 1.25rem;">
                                Thank you for choosing our medical services. Your registration is now complete.
                            </p>
                            
                            <div class="alert alert-light border-primary border-1 mt-4 mb-4" style="background-color: #f0f9ff;">
                                <p class="mb-0" style="color: #01579b;">
                                    <i class="bi bi-info-circle-fill text-primary me-2"></i>
                                    Kindly visit our reception desk to complete your medical registration process.
                                </p>
                            </div>
                            
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center mt-5">
                                <a href="/" class="btn btn-primary btn-lg px-4 py-3 me-sm-3" style="border-radius: 8px; background-color: #0288d1; border-color: #0288d1;">
                                    <i class="bi bi-house-door-fill me-2"></i> Return Home
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-lg px-4 py-3" style="border-radius: 8px; color: #0288d1; border-color: #0288d1;">
                                    <i class="bi bi-telephone-fill me-2"></i> Contact Reception
                                </a>
                            </div>
                            <div class="text-center mt-4">
                                <a href="{{ route('qr.registration.form') }}?new=1" class="btn btn-primary">
                                    Start New Registration
                                </a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection