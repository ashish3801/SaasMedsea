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
                                <h5 class="card-title mb-0">Agents Table</h5>
                                <a href="{{ route('agents.create') }}" class="btn btn-primary"><i class="ri-add-line"></i></a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Name</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone No.</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($agents)
                                            @foreach ($agents as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->company->name ?? 'N/A' }}</td> 
                                                    <td>{{ $item->email }}</td>  
                                                    <td>{{ $item->phone_no }}</td>
                                                    
                                                    <td><a href="{{ route('agents.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="ri-edit-2-line"></i></a></td>
                                                    
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

    </main>
@endsection
