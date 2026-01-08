{{-- @if(isset($tests) && count($tests) > 0)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $categoryName }}</h5>
            <form id="generic-test-form-{{ Str::slug($categoryName) }}" class="generic-test-form">
                @csrf
                <input type="hidden" name="registration_id" value="{{ $registrationId }}">
                <input type="hidden" name="category_name" value="{{ $categoryName }}">

                @foreach($tests as $test)
                    <div class="test-section mb-4 border-bottom pb-3">
                        <h6 class="mb-3">{{ $test['name'] }}</h6>
                        <input type="hidden" name="test_ids[]" value="{{ $test['test_id'] }}">
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Result</label>
                                    <textarea 
                                        class="form-control" 
                                        name="results[{{ $test['test_id'] }}][result]" 
                                        rows="2" 
                                        placeholder="Enter result for {{ $test['name'] }}"
                                    ></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="results[{{ $test['test_id'] }}][status]" required>
                                        <option value="">Select Status</option>
                                        <option value="normal">Normal</option>
                                        <option value="abnormal">Abnormal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="results[{{ $test['test_id'] }}][remarks]" 
                                        placeholder="Enter remarks for {{ $test['name'] }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save {{ $categoryName }} Results
                    </button>
                </div>
            </form>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <p class="mb-0">No tests available for {{ $categoryName }} in your assigned package(s).</p>
    </div>
@endif --}}


@if(isset($tests) && count($tests) > 0)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $categoryName }}</h5>
            <form id="generic-test-form-{{ Str::slug($categoryName) }}" class="generic-test-form">
                @csrf
                <input type="hidden" name="registration_id" value="{{ $registrationId }}">
                <input type="hidden" name="category_name" value="{{ $categoryName }}">

                @foreach($tests as $test)
                    <div class="test-section mb-4 border-bottom pb-3">
                        <h6 class="mb-3">{{ $test['name'] }}</h6>
                        <input type="hidden" name="test_ids[]" value="{{ $test['test_id'] }}">
                        
                        <div class="row">
                            @if($test['type'] === 'dropdown')
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Result</label>
                                        <select class="form-control" name="results[{{ $test['test_id'] }}][result]" required>
                                            <option value="">Select Result</option>
                                            <option value="positive">Positive</option>
                                            <option value="negative">Negative</option>
                                            <option value="inconclusive">Inconclusive</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Result</label>
                                        <textarea 
                                            class="form-control" 
                                            name="results[{{ $test['test_id'] }}][result]" 
                                            rows="2" 
                                            placeholder="Enter result for {{ $test['name'] }}"
                                        ></textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="results[{{ $test['test_id'] }}][status]" required>
                                        <option value="">Select Status</option>
                                        <option value="normal">Normal</option>
                                        <option value="abnormal">Abnormal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="results[{{ $test['test_id'] }}][remarks]" 
                                        placeholder="Enter remarks for {{ $test['name'] }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save {{ $categoryName }} Results
                    </button>
                </div>
            </form>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <p class="mb-0">No tests available for {{ $categoryName }} in your assigned package(s).</p>
    </div>
@endif

<script>
$(document).ready(function() {
    $('.generic-test-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        
        // Validate required fields
        var isValid = true;
        form.find('select[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            alert('Please select a status for all tests.');
            return;
        }

        // Disable submit button and show loading state
        submitBtn.prop('disabled', true).html('<i class="bi bi-hourglass"></i> Saving...');

        $.ajax({
            url: '/save-test-results',
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Show success message
                alert('Test results saved successfully!');
                
                // Optionally, you can update the UI to show saved state
                form.find('textarea, input[type="text"]').addClass('is-valid');
                form.find('select').addClass('is-valid');
            },
            error: function(xhr) {
                // Show error message
                alert('Error saving test results: ' + (xhr.responseJSON?.message || 'Unknown error'));
                console.error(xhr.responseText);
            },
            complete: function() {
                // Reset button state
                submitBtn.prop('disabled', false).html('<i class="bi bi-save"></i> Save {{ $categoryName }} Results');
            }
        });
    });

    // Clear validation states when input changes
    $('.generic-test-form').on('input change', 'textarea, input, select', function() {
        $(this).removeClass('is-invalid is-valid');
    });
});
</script>
