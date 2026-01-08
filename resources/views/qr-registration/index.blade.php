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
                                <h5 class="card-title mb-0">QR Registrations</h5>
                                {{-- If you want to add a button here, you can, otherwise omit this --}}
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#qrModal">
                                    <i class="ri-add-line"></i> View QR
                                </a>

                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                   <thead>
                                      <tr>
                                         <th>Sr.</th>
                                         <th>Name</th>
                                         <th>Indos No.</th>
                                         <th>Passport No.</th>
                                         <th>Contact</th>
                                         <th>Rank</th>
                                         <th>Clinic</th>
                                         <th>Date</th>
                                         <th>Actions</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @if ($registrations && $registrations->count() > 0)
                                         @foreach ($registrations as $registration)
                                             <tr>
                                                 <td>{{ $loop->iteration }}</td>
                                                 <td>{{ $registration->first_name }} {{ $registration->last_name }}</td>
                                                 <td>{{ $registration->indos_no }}</td>
                                                 <td>{{ $registration->passport_no }}</td>
                                                 <td>{{ $registration->contact_number }}</td>
                                                 <td>{{ $registration->rank->name ?? 'N/A' }}</td>
                                                 <td>{{ $registration->clinic->name ?? 'N/A' }}</td>
                                                 <td>{{ $registration->created_at->format('d-M-Y') }}</td>
                                                 <td>
                                                    <a href="{{ route('registrations.qr.show', $registration->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="ri-eye-line"></i>
                                                    </a>

                                                     <form action="{{ route('registrations.accept',$registration->id) }}"
                                                          method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success"><i class="ri-check-line"></i></button>
                                                    </form>
                                                
                                                    <form action="{{ route('registrations.decline',$registration->id) }}"
                                                          method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="ri-close-line"></i></button>
                                                    </form>
                                                 </td>
                                             </tr>
                                         @endforeach
                                      @else
                                         <tr>
                                             <td colspan="9" class="text-center">No registrations found.</td>
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
    @php
        use Illuminate\Support\Facades\Crypt;
    
        $plainUrl = 'registration-qr-form?qr=1';
        $encrypted = Crypt::encryptString($plainUrl);
        $encryptedUrl = url('registration-qr-form') . '?data=' . urlencode($encrypted);
    @endphp
    <!-- QR Modal for General Registration -->
    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content text-center p-3">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="qrModalLabel">Scan to Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! QrCode::size(200)->generate('https://ah.cliqmeds.com/qr-registration') !!}
            <!--<p class="mt-2 small text-muted">https://ah.cliqmeds.com/registration-qr-form?qr=1</p>-->
            <!--{!! QrCode::size(200)->generate($encryptedUrl) !!}-->
          </div>
           
        </div>
      </div>
    </div>
<!-- Bootstrap JS & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
