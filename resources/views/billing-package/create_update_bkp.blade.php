@extends('layout.layout')
@section('content')
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Billing Package Form</h5>

                        <!-- Billing Package Form -->
                        <form action="{{ isset($billingPackage) ? route('billing-packages.update', $billingPackage->id) : route('billing-packages.store') }}" method="POST">
                            @csrf
                            @if (isset($billingPackage))
                                @method('PUT')
                            @endif

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Package Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $billingPackage->name ?? '') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                    <div class="col-md-4">
                                        <label for="category_id" class="form-label">Billing Category</label>
                                        <select class="form-select" id="category_id" name="category_id[]" multiple>
                                            @foreach ($billingCategories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, old('category_id', $billingPackage->category_id ?? [])) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Billing Category Other</label>
                                        <input type="text" class="form-control @error('other_category') is-invalid @enderror"
                                            id="other_category" name="other_category" value="{{ old('other_category', $billingPackage->other_category ?? '') }}">
                                        @error('other_category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                <div class="col-md-4">
                                    {{-- <label for="billing_item_id" class="form-label">Billing Item</label>
                                    <select class="form-select multiselect" id="test_id" name="test_id[]" multiple>
                                        @foreach ($billingItems as $item)
                                            <option value="{{ $item->id }}"
                                                {{ in_array($item->id, old('test_id', $billingPackage->test_id ?? [])) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <label for="test_id" class="form-label">Billing Item</label>
                                    <select class="form-select multiselect" id="test_id" name="test_id[]" multiple>
                                        <!-- Test options will be populated dynamically -->
                                    </select>
                                    @error('test_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-4">
                                    <label for="name" class="form-label">Billing Test Other</label>
                                    <input type="text" class="form-control @error('other_test') is-invalid @enderror"
                                        id="other_test" name="other_test" value="{{ old('other_test', $billingPackage->other_test ?? '') }}">
                                    @error('other_test')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="col-md-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $billingPackage->price ?? '') }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                                        id="discount_price" name="discount_price"
                                        value="{{ old('discount_price', $billingPackage->discount_price ?? '') }}">
                                    @error('discount_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                 <div class="text-center">
                                    <button type="button" id="submit-billing-package-form" class="btn btn-primary"><i
                                            class="ri-arrow-right-circle-line"></i></button>
                                </div>
                        </form>
                        <!-- End Billing Package Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@if(isset($billingPackage))
    <script>
        var preselectedTests = {!! json_encode(old('test_id', $billingPackage->test_id ?? [])) !!};
        var preselectedCategories = {!! json_encode(old('category_id', $billingPackage->category_id ?? [])) !!};
    </script>
@else
    <script>
        var preselectedTests = [];
        var preselectedCategories = [];
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#test_id, #category_id').select2({
            placeholder: "Select Items",
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });

        $('#test_id').select2({
            placeholder: "Select Tests",
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });

        $('#category_id').on('change', function() {
        var selectedCategories = $(this).val(); 
        if (selectedCategories && selectedCategories.length > 0) {
            $.ajax({
                url: '/billing-packages/tests/' + selectedCategories[0],
                type: 'GET',
                data: { category_id: selectedCategories },
                success: function(response) {
                    response.forEach(function(test) {
                        if ($('#test_id option[value="'+ test.id +'"]').length === 0) {
                            $('#test_id').append(new Option(test.name, test.id, false, false));
                        }
                    });
                    if (typeof preselectedTests !== 'undefined' && preselectedTests.length > 0) {
                        $('#test_id').val(preselectedTests).trigger('change');
                    }
                },
                error: function() {
                    alert('Error loading tests for the selected category.');
                }
            });
        }
    });

    // For edit mode: if preselectedCategories exists, trigger change on the category select
    if (typeof preselectedCategories !== 'undefined' && preselectedCategories.length > 0) {
        $('#category_id').val(preselectedCategories).trigger('change');
    }
    });
</script>
<script>
    $(document).ready(function() {

        $('#submit-billing-package-form').click(function(e) {
            e.preventDefault();

            $('.invalid-feedback').text('');
            $('.is-invalid').removeClass('is-invalid');

           
            var formData = {
                name: $('#name').val(),
                category_id: $('#category_id').val(),
                test_id: $('#test_id').val(),
                other_category: $('#other_category').val(),
                other_test: $('#other_test').val(),
                price: $('#price').val(),
                discount_price: $('#discount_price').val(),
                total: $('#total').val(),
                _token: "{{ csrf_token() }}", 
                @if (isset($billingPackage))
                    _method: 'PUT' 
                @endif
            };

            // AJAX request
            $.ajax({
                url: "{{ isset($billingPackage) ? route('billing-packages.update', $billingPackage->id) : route('billing-packages.store') }}", // Dynamic URL
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Success message or redirect
                    alert('Billing package saved successfully');
                    // window.location.href = "{{ route('billing-packages.index') }}"; // Redirect to index page
                },
                error: function(response) {
                    if (response.status === 422) {
                        // Validation errors from the server (Laravel validation)
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass(
                            'is-invalid'); // Highlight field with error
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
