<script src="{{ asset('/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('/assets/js/main.js') }}"></script>

<script>
    // Close alert after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var alertInstance = bootstrap.Alert.getOrCreateInstance(alert);
                alertInstance.close(); // Auto-close the alert
            });
        }, 3000); // 3 seconds
    });
</script>
