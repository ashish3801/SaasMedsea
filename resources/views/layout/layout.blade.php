<!DOCTYPE html>
<html lang="en">

@include('layout.header')

<body>

    <div id="loader" class="d-none position-fixed w-100 h-100"
        style="top: 0; left: 0; background-color: rgba(255, 255, 255, 0.8); z-index: 9999; display: flex; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- ======= Header ======= -->
 
        @include('layout.nav-bar')
    
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    

        @include('layout.sidebar')
    <!-- End Sidebar-->
    <div id="alerts-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show   m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show   m-3" role="alert">
                {{ $errors->first() }} <!-- Display the first error message -->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>



    @yield('content')
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layout.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>



    <script>
        // Show loader when the page starts loading
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Set a timeout to show the loader after 3 seconds
        //     const loader = document.getElementById('loader');
        //     const loaderTimeout = setTimeout(function() {
        //         loader.classList.remove('d-none');
        //     }, 3000); // 3 seconds

        //     // Hide loader when the page has fully loaded
        //     window.addEventListener('load', function() {
        //         // Clear the timeout if the page loads before 3 seconds
        //         clearTimeout(loaderTimeout);
        //         loader.style.display = 'none';
        //     });
        // });
    </script>

    <!-- Vendor JS Files -->
    @include('layout.script')

</body>

</html>
