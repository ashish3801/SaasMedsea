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
                                <h5 class="card-title mb-0">Administrator Table</h5>
                                <a href="{{ route('administrator.create') }}" class="btn btn-primary"><i class="ri-add-line"></i></a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable"> <!-- Changed class to match Agents Table design -->
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Administrator Name</th>
                                            <th>Email</th>
                                            <th>Phone</th> 
                                            <th>Company</th> 
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($administrators as $administrator)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $administrator->name }}</td>
                                                <td>{{ $administrator->email }}</td> 
                                                <td>{{ ($administrator->phone_no) }} </td>
                                                <td>{{ $administrator->company->name ?? '' }}</td>
                                                 <td>
                                                    <a href="{{ route('administrator.show', $administrator->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="ri-edit-2-line"></i>
                                                    </a>
                                                    <form action="{{ route('administrator.destroy', $administrator->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination Links -->
                            {{ $administrators->links() }}
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
