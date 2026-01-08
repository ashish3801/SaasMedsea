<div class="modal fade" id="earlargeModal" tabindex="-1">

    {{-- <div id="alerts-container"></div> --}}
    
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Medical Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <h6></h6>
                                    <!-- Tabs -->
                                    @include('registration.include.tab')

                                    <!-- Tab Contents -->
                                    <div class="tab-content pt-2" id="myTabContent">
                                        <!-- cbc Tab -->
                                        @include('registration.include.cbc_form')

                                        <!-- urine Tab -->
                                        @include('registration.include.urine_form')

                                        <!-- serology Tab -->
                                        @include('registration.include.serology_form')

                                        <!-- eye Tab -->
                                        @include('registration.include.eye_form')

                                        <!-- ear Tab -->
                                        @include('registration.include.ear_form')

                                        <!-- drug-alcohol Tab -->
                                        @include('registration.include.xray_form')

                                        <!-- usg Tab -->
                                        @include('registration.include.usg_form')

                                        <!-- ecg Tab -->
                                        @include('registration.include.ecg_form')

                                        <!-- dna Tab -->
                                        @include('registration.include.dna_form')

                                        <!-- physical Tab -->
                                        @include('registration.include.physical_form')

                                        <!-- biochemistry Tab -->
                                        @include('registration.include.biochemistry_form')

                                        @include('registration.include.stool_routin_form')

                                        @include('registration.include.stress_form')

                                        @include('registration.include.echo_form')
                                        <!-- doctors-record Tab -->
                                        @include('registration.include.doctors_record')

                                        <!-- declaration-record Tab -->
                                        @include('registration.include.declaration')

                                        @include('registration.include.dr_approval')

                                    </div>
                                    <!-- End of Tab Contents -->

                                </div>
                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
