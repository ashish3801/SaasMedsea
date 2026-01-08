@extends('layout.layout')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ isset($billingCategory) ? 'Edit Billing Category' : 'Create Billing Category' }}</h5>

                            <form method="POST"
                                  action="{{ isset($billingCategory) ? route('billing-categories.update', $billingCategory->id) : route('billing-categories.store') }}">
                                @csrf
                                @if (isset($billingCategory))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name"
                                               value="{{ old('name', $billingCategory->name ?? '') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="test_id" class="form-label">Select Tests</label>
                                        <select class="form-select multiselect @error('test_id') is-invalid @enderror" 
                                                id="test_id" name="test_id[]" multiple>
                                            @foreach ($tests as $test)
                                                <option value="{{ $test->id }}"
                                                    @if(in_array($test->id, 
                                                        old('test_id', 
                                                            isset($billingCategory) ? $billingCategory->tests->pluck('id')->toArray() : []
                                                        )))
                                                        selected
                                                    @endif>
                                                    {{ $test->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('test_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                               id="price" name="price"
                                               value="{{ old('price', $billingCategory->price ?? '') }}" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="discount_price" class="form-label">Discount Price</label>
                                        <input type="text"
                                               class="form-control @error('discount_price') is-invalid @enderror"
                                               id="discount_price" name="discount_price"
                                               value="{{ old('discount_price', $billingCategory->discount_price ?? '') }}">
                                        @error('discount_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-save-line"></i> {{ isset($billingCategory) ? 'Update' : 'Save' }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
