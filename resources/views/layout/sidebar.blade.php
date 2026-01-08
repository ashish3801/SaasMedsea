<aside id="sidebar" class="sidebar">

    @php
        $u = auth()->user();
        $permissions = json_decode($u->permissions ?? '[]', true);
    @endphp

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- SUPER ADMIN ALWAYS GETS DASHBOARD --}}
        @if($u->role_id == 1 || $u->hasPermission('dashboard'))
            <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endif


        {{-- REGISTRATION --}}
        @if($u->hasPermission('registration'))
            <li class="nav-item {{ Route::is('registrations.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('registrations.index') }}">
                    <i class="bi bi-journal-medical"></i>
                    <span>Registration</span>
                </a>
            </li>
        @endif


        {{-- BILLINGS --}}
        @if($u->hasPermission('billings'))
            <li class="nav-item {{ Route::is('billing-*') ? 'active' : '' }}">
                <a class="nav-link collapsed" data-bs-target="#billing-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-basket"></i>
                    <span>Billings</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>

                <ul id="billing-nav" class="nav-content collapse {{ Route::is('billing-*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">

                    @if($u->hasPermission('billing_test'))
                        <li>
                            <a href="{{ route('billing-items.index') }}" class="{{ Route::is('billing-items.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Billing Test</span>
                            </a>
                        </li>
                    @endif

                    @if($u->hasPermission('billing_category'))
                        <li>
                            <a href="{{ route('billing-categories.index') }}" class="{{ Route::is('billing-categories.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Billing Categories</span>
                            </a>
                        </li>
                    @endif

                    @if($u->hasPermission('billing_package'))
                        <li>
                            <a href="{{ route('billing-packages.index') }}" class="{{ Route::is('billing-packages.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Billing Package</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif


        {{-- AGENT --}}
        @if($u->hasPermission('agent'))
            <li class="nav-item {{ Route::is('agents.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('agents.index') }}">
                    <i class="bi bi-person-plus"></i>
                    <span>Agent</span>
                </a>
            </li>
        @endif


        {{-- EMPLOYEE --}}
        @if($u->hasPermission('employee'))
            <li class="nav-item {{ Route::is('employees.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('employees.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Employee</span>
                </a>
            </li>
        @endif


        {{-- CLINIC --}}
        @if($u->hasPermission('clinic'))
            <li class="nav-item {{ Route::is('clinics.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('clinics.index') }}">
                    <i class="bi bi-hospital"></i>
                    <span>Clinic</span>
                </a>
            </li>
        @endif


        {{-- USER ROLE --}}
        @if($u->hasPermission('user_role'))
            <li class="nav-item {{ Route::is('get-user-role.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('get-user-role.index') }}">
                    <i class="bi bi-people"></i>
                    <span>User Role</span>
                </a>
            </li>
        @endif


        {{-- QR REGISTRATIONS --}}
        @if($u->hasPermission('qr_registration'))
            <li class="nav-item {{ Route::is('qr.registrations.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('qr.registrations.index') }}">
                    <i class="bi bi-qr-code"></i>
                    <span>QR Registrations</span>
                </a>
            </li>
        @endif


        {{-- SUPER ADMIN ONLY --}}
        @if($u->role_id == 1)
            <li class="nav-item {{ Route::is('company.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('company.index') }}">
                    <i class="bi bi-building"></i>
                    <span>Company</span>
                </a>
            </li>

            <li class="nav-item {{ Route::is('administrator.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.index') }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Administrators</span>
                </a>
            </li>
        @endif

    </ul>
</aside>
