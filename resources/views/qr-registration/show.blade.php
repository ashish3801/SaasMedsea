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
                                <h5 class="card-title mb-0">Registration Detail</h5>
                                <a href="{{ route('registrations.index') }}" class="btn btn-primary"><i class="ri-arrow-left-line"></i> Back</a>
                            </div>

                            <table class="table table-bordered mt-3">
                                <tbody>
                                   <tr>
                                      <th>ID</th>
                                      <td>{{ $registration->id }}</td>
                                   </tr>
                                   <tr>
                                      <th>Full Name</th>
                                      <td>{{ $registration->first_name }} {{ $registration->last_name }}</td>
                                   </tr>
                                   <tr>
                                      <th>Indos Number</th>
                                      <td>{{ $registration->indos_no }}</td>
                                   </tr>
                                   <tr>
                                      <th>Passport Number</th>
                                      <td>{{ $registration->passport_no }}</td>
                                   </tr>
                                   <tr>
                                      <th>Contact Number</th>
                                      <td>{{ $registration->contact_number }}</td>
                                   </tr>
                                   <tr>
                                      <th>Rank</th>
                                      <td>{{ $registration->rank->name ?? 'N/A' }}</td>
                                   </tr>
                                   <tr>
                                      <th>Clinic</th>
                                      <td>{{ $registration->clinic->name ?? 'N/A' }}</td>
                                   </tr>
                                   <tr>
                                      <th>Date</th>
                                      <td>{{ $registration->created_at->format('d-M-Y') }}</td>
                                   </tr>
                                   {{-- If you have additional fields to show, add them here in the same format --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
