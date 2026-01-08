@extends('layout.layout')
@section('content')
    <main id="main" class="main">

       

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-100"> <!-- Added padding to match the Agents Table style -->
                        <br> <!-- Added spacing similar to Agents Table -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Company Table</h5>
                                <a href="{{ route('company.create') }}" class="btn btn-primary"><i class="ri-add-line"></i></a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable"> <!-- Changed class to match Agents Table design -->
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Address</th>
                                            <th>Contact</th> 
                                            <th>Logo</th> 
                                            <th>Status</th> 
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ \Illuminate\Support\Str::words($company->address, 8, '...') }}</td>
                                                <td>{{ $company->contact }}</td> 
                                                <td>
                                                    @if($company->logo)
                                                        <img src="{{ asset('images/' . $company->logo) }}" alt="{{ $company->name }}" width="50" height="50">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($company->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                 <td>
                                                    <a href="{{ route('company.show', $company->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="ri-edit-2-line"></i>
                                                    </a>
                                                    <form action="{{ route('company.destroy', $company->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="ri-delete-bin-line"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination Links -->
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // prevent default form submission
                    const confirmDelete = confirm("Are you sure you want to delete this company?");
                    if (confirmDelete) {
                        form.submit(); // submit form if confirmed
                    }
                });
            });
        });
    </script>

@endsection
