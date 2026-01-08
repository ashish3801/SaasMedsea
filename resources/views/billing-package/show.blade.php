@extends('layout.layout')

@section('content')
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Billing Package Details</h5>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label"><strong>Package Name:</strong></label>
                                <p>{{ $billingPackage->name }}</p>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><strong>Billing Categories:</strong></label>
                                <ul>
                                    @foreach ($billingCategories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><strong>Billing Categories Other:</strong></label>
                                <p>{{ $billingPackage->other_category }}</p>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><strong>Billing Items:</strong></label>
                                <ul>
                                    @foreach ($categorizedTests as $categoryName => $tests)
                                        <li><strong>{{ $categoryName }}:</strong>
                                            <ul>
                                                @foreach ($tests as $testName)
                                                    <li>{{ $testName }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><strong>Billing Items Other:</strong></label>
                                <p>{{ $billingPackage->other_test }}</p>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><strong>Price:</strong></label>
                                <p>{{ number_format($billingPackage->price, 2) }}</p>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><strong>Discount Price:</strong></label>
                                <p>{{ number_format($billingPackage->discount_price, 2) ?? 'N/A' }}</p>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('billing-packages.index') }}" class="btn btn-secondary">Back</a>
                                <a href="{{ route('billing-packages.edit', $billingPackage->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
