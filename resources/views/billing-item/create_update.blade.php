@extends('layout.layout')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Billing Item Form</h5>

                            <!-- Registration Form -->
                            <form action="{{ isset($item) ? route('billing-items.update', $item->id) : route('billing-items.store') }}" method="POST">
                                @csrf
                                @if (isset($item))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                               value="{{ old('name', $item->name ?? '') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="field_type">Field Type</label>
                                        <select name="field_type" id="field_type" class="form-control" required>
                                            <option value="text" {{ old('field_type', $item->field_type ?? '') == 'text' ? 'selected' : '' }}>Text</option>
                                            <option value="dropdown" {{ old('field_type', $item->field_type ?? '') == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                                        </select>
                                    </div>
                                
                                    <!-- For dropdown fields -->
                                    <div class="form-group" id="dropdown_values" style="display: none;">
                                        <label for="dropdown_values">Dropdown Values (Comma Separated)</label>
                                        <input type="text" name="dropdown_values" class="form-control" 
                                            value="{{ old('dropdown_values', isset($item) && $item->dropdown_values ? implode(',', json_decode($item->dropdown_values, true)) : '') }}">
                                    </div>
                                
                                    <!-- For text fields -->
                                    <div class="form-group" id="text_value" style="display: none;">
                                        <label for="text_value">Text Value</label>
                                        <input type="text" name="text_value" id="text_value" class="form-control" value="{{ old('text_value', $item->text_value ?? '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                               value="{{ old('price', $item->price ?? '') }}">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="discount_price" class="form-label">Discount Price</label>
                                        <input type="text" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price"
                                               name="discount_price" value="{{ old('discount_price', $item->discount_price ?? '') }}">
                                        @error('discount_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-arrow-right-circle-line"></i> {{ isset($item) ? 'Update' : 'Save' }}
                                        </button>
                                    </div>
                                </div>
                            </form><!-- Registration Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fieldType = document.getElementById('field_type');
            var dropdownValues = document.getElementById('dropdown_values');
            var textValue = document.getElementById('text_value');

            function toggleFields() {
                if (fieldType.value === 'dropdown') {
                    dropdownValues.style.display = 'block';
                    textValue.style.display = 'none';
                } else {
                    dropdownValues.style.display = 'none';
                    textValue.style.display = 'block';
                }
            }

            fieldType.addEventListener('change', toggleFields);
            toggleFields(); // Initialize on page load
        });
    </script>
    
@endsection