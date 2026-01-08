<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registration Form</title>
    
    <!-- Include your existing header content -->
    @include('layout.header')
</head>

<body>
    <!-- Minimal loader (same as your current one) -->
    <div id="loader" class="d-none position-fixed w-100 h-100"
        style="top: 0; left: 0; background-color: rgba(255, 255, 255, 0.8); z-index: 9999; display: flex; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Alerts container -->
    <div id="alerts-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main content -->
    <main class="min-vh-100 d-flex align-items-center">
        @yield('content')
    </main>
    <script>
    // Keep session alive by pinging every 5 minutes
    setInterval(() => {
        fetch('/keep-alive')
            .then(response => response.json())
            .then(data => console.log('Session kept alive:', data))
            .catch(err => console.error('Keep-alive failed:', err));
    }, 300000); // 5 minutes
    </script>
    <!-- Include your existing scripts -->
    @include('layout.script')
</body>
</html>