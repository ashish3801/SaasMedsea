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
                                <h5 class="card-title mb-0">Clinics Table</h5>
                                <a href="{{ route('clinics.create') }}" class="btn btn-primary"><i class="ri-add-line"></i></a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable"> <!-- Changed class to match Agents Table design -->
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Clinic Name</th>
                                            <th>Address</th>
                                            <th>Logo</th>
                                            <th>Stamp</th>
                                            <th>Branch</th> 
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clinics as $clinic)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $clinic->name }}</td>
                                                <td>{{ \Illuminate\Support\Str::words($clinic->address, 8, '...') }}</td>
                                                <td>
                                                    @if($clinic->logo)
                                                        <img src="{{ asset('images/' . $clinic->logo) }}" alt="{{ $clinic->name }}" width="50" height="50">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($clinic->stamp)
                                                        <img src="{{ asset('images/' . $clinic->stamp) }}" alt="{{ $clinic->name }}" width="50" height="50">
                                                    @else
                                                        N/A
                                                    @endif
                                                <td>{{ $clinic->branch }}</td> <!-- Assuming city is a relationship -->
                                               
                                                <td>
                                                    <a href="{{ route('clinics.show', $clinic->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="ri-edit-2-line"></i></a>
                                                    <!--<form action="{{ route('clinics.destroy', $clinic->id) }}" method="POST"-->
                                                    <!--    style="display:inline-block;">-->
                                                    <!--    @csrf-->
                                                    <!--    @method('DELETE')-->
                                                    <!--    <button type="submit" class="btn btn-danger btn-sm">Delete</button>-->
                                                    <!--</form>-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination Links -->
                            {{ $clinics->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
