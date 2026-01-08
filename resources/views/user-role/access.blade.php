@extends('layout.layout')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Assign Access to {{ $employee->emp_name }}</h1>
    </div>

    <section class="section">
        <div class="card p-4">
            <form action="{{ route('user-role.access.update', $employee->id) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Employee Name</label>
                        <input type="text" value="{{ $employee->emp_name }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label>Employee Email</label>
                        <input type="text" value="{{ $employee->email }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user?->role?->name ?? 'N/A') }}" readonly>
                        <input type="hidden" name="role_id" value="{{ $user?->role_id }}">
                    </div>
                    <div class="col-md-6">
                        <label>Create/Change Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                        <small class="text-muted">Leave blank to keep the current password.</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label><strong>Module Access</strong></label>
                    <div class="row">
                        <!-- Dashboard -->
                        <div class="col-md-3">
                            <label><input type="checkbox" name="permissions[]" value="dashboard"
                                {{ in_array('dashboard', $employeePermissions ?? []) ? 'checked' : '' }}> Dashboard</label>
                        </div>

                        <!-- Registration -->
                        {{-- <div class="col-md-3">
                            <label><input type="checkbox" name="permissions[]" value="registration"
                                {{ in_array('registration', $employeePermissions ?? []) ? 'checked' : '' }}> Registration</label>
                        </div> --}}
                        <div class="col-md-12 mt-3">
                            <strong>Registration</strong>
                            <div class="row ps-3">
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="registration"
                                            {{ in_array('registration_index', $employeePermissions ?? []) ? 'checked' : '' }}>
                                        View Registrations
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="registration_create"
                                            {{ in_array('registration_create', $employeePermissions ?? []) ? 'checked' : '' }}>
                                        Create Registration
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="registration_edit"
                                            {{ in_array('registration_edit', $employeePermissions ?? []) ? 'checked' : '' }}>
                                        Edit Registration
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="registration_show"
                                            {{ in_array('registration_show', $employeePermissions ?? []) ? 'checked' : '' }}>
                                        Show Details
                                    </label>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="registration_upload"
                                            {{ in_array('registration_upload', $employeePermissions ?? []) ? 'checked' : '' }}>
                                        Upload Documents
                                    </label>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="registration_download"
                                            {{ in_array('registration_download', $employeePermissions ?? []) ? 'checked' : '' }}>
                                        Download Reports
                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Billings (Parent + Submodules) -->
                        <div class="col-md-12 mt-3">
                            <strong>Billings</strong>
                            <div class="row ps-3">
                                <div class="col-md-3">
                                    <label><input type="checkbox" name="permissions[]" value="billing_test"
                                        {{ in_array('billing_test', $employeePermissions ?? []) ? 'checked' : '' }}> Billing Test</label>
                                </div>
                                <div class="col-md-3">
                                    <label><input type="checkbox" name="permissions[]" value="billing_category"
                                        {{ in_array('billing_category', $employeePermissions ?? []) ? 'checked' : '' }}> Billing Category</label>
                                </div>
                                <div class="col-md-3">
                                    <label><input type="checkbox" name="permissions[]" value="billing_package"
                                        {{ in_array('billing_package', $employeePermissions ?? []) ? 'checked' : '' }}> Billing Package</label>
                                </div>
                            </div>
                        </div>

                        <!-- Agent -->
                        <div class="col-md-3 mt-3">
                            <label><input type="checkbox" name="permissions[]" value="agent"
                                {{ in_array('agent', $employeePermissions ?? []) ? 'checked' : '' }}> Agent</label>
                        </div>

                        <!-- Employee -->
                        <div class="col-md-3 mt-3">
                            <label><input type="checkbox" name="permissions[]" value="employee"
                                {{ in_array('employee', $employeePermissions ?? []) ? 'checked' : '' }}> Employee</label>
                        </div>

                        <!-- Clinic -->
                        <div class="col-md-3 mt-3">
                            <label><input type="checkbox" name="permissions[]" value="clinic"
                                {{ in_array('clinic', $employeePermissions ?? []) ? 'checked' : '' }}> Clinic</label>
                        </div>

                        <!-- User Role -->
                        <div class="col-md-3 mt-3">
                            <label><input type="checkbox" name="permissions[]" value="user_role"
                                {{ in_array('user_role', $employeePermissions ?? []) ? 'checked' : '' }}> User Role</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Access</button>
                <a href="{{ route('get-user-role.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </section>
</main>
@endsection
