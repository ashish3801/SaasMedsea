@extends('layout.layout')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card pt-100">
                        <br>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0"> Billing Category Table</h5>
                                <a href="{{ route('billing-categories.create') }}" class="btn btn-primary"><i
                                        class="ri-add-line"></i></a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Discount Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($categories)
                                            @foreach ($categories as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td> 
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->discount_price }}</td>

                                                    <td><a href="{{ route('billing-categories.show', $item->id) }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="ri-edit-2-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" 
                                                            class="btn btn-primary btn-sm view-category-btn" 
                                                            data-id="{{ $item->id }}">
                                                                <i class="ri-eye-line"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12">No registrations found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- Category Details Modal -->
<div class="modal fade" id="categoryDetailModal" tabindex="-1" aria-labelledby="categoryDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="categoryDetailContent">
                <div class="text-center">Loading...</div>
            </div>

            <div class="modal-footer">
                <a href="#" id="editCategoryBtn" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    </main>
    <!-- Category Details Modal -->
    <script>
        $(document).ready(function () {
            $('.view-category-btn').click(function () {
                var categoryId = $(this).data('id');
                $('#categoryDetailModal').modal('show');
                $('#categoryDetailContent').html('<div class="text-center">Loading...</div>');
    
                $.ajax({
                    url: '/billing-categories/' + categoryId,
                    type: 'GET',
                    success: function (response) {
                        let html = `
                            <h5><strong>Name:</strong> ${response.name}</h5>
                            <p><strong>Price:</strong> ₹${response.price}</p>
                            <p><strong>Discount Price:</strong> ₹${response.discount_price ?? 'N/A'}</p>
                        `;
    
                        if (response.tests && response.tests.length > 0) {
                            html += `<h6 class="mt-3">Associated Tests:</h6><ul>`;
                            response.tests.forEach(function (test) {
                                html += `<li>${test.name} - ₹${test.price}</li>`;
                            });
                            html += `</ul>`;
                        } else {
                            html += `<p>No tests linked to this category.</p>`;
                        }
    
                        $('#categoryDetailContent').html(html);
                    },
                    error: function () {
                        $('#categoryDetailContent').html('<div class="text-danger">Failed to load details.</div>');
                    }
                });
            });
        });
    </script>
    
@endsection