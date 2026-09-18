<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- =========================================================
         BRAND
    ========================================================== --}}

    <div class="sidebar-brand">

        <a href="{{ route('dashboard') }}" class="brand-link">

            <span class="brand-text fw-light">
                AMC SARL
            </span>

        </a>

    </div>


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <div class="sidebar-wrapper">

        <nav class="mt-2">

            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >


                {{-- =================================================
                     MAIN MENU
                ================================================== --}}

                <li class="nav-header">
                    MAIN MENU
                </li>


                <li class="nav-item">

                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                    >

                        <i class="nav-icon bi bi-speedometer"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>


                {{-- =================================================
                     REQUESTS
                ================================================== --}}

                @can('requests.view')

                    <li class="nav-header">
                        REQUESTS
                    </li>


                    <li class="nav-item">

                        <a
                            href="{{ route('requests.index') }}"
                            class="nav-link {{ request()->routeIs('requests.index') ? 'active' : '' }}"
                        >

                            <i class="nav-icon bi bi-file-earmark-text"></i>

                            <p>
                                Requests
                            </p>

                        </a>

                    </li>

                @endcan


                {{-- =================================================
                     PROCUREMENT
                ================================================== --}}

                @canany(['procurement.view', 'procurement.approve', 'procurement.reject'])

                    <li class="nav-header">
                        PROCUREMENT
                    </li>


                    {{-- Pending --}}

                    @can('procurement.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('procurement.pending') }}"
                                class="nav-link {{ request()->routeIs('procurement.pending') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-hourglass-split"></i>

                                <p>
                                    Pending Validation
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Approved --}}

{{--                    @can('procurement.view')--}}

{{--                        <li class="nav-item">--}}

{{--                            <a--}}
{{--                                href="{{ route('requests.approved') }}"--}}
{{--                                class="nav-link {{ request()->routeIs('requests.approved') ? 'active' : '' }}"--}}
{{--                            >--}}

{{--                                <i class="nav-icon bi bi-check-circle"></i>--}}

{{--                                <p>--}}
{{--                                    Approved Requests--}}
{{--                                </p>--}}

{{--                            </a>--}}

{{--                        </li>--}}

{{--                    @endcan--}}


{{--                    --}}{{-- Rejected --}}

{{--                    @can('procurement.view')--}}

{{--                        <li class="nav-item">--}}

{{--                            <a--}}
{{--                                href="{{ route('procurement.requests.rejected') }}"--}}
{{--                                class="nav-link {{ request()->routeIs('procurement.requests.rejected') ? 'active' : '' }}"--}}
{{--                            >--}}

{{--                                <i class="nav-icon bi bi-x-circle"></i>--}}

{{--                                <p>--}}
{{--                                    Rejected Requests--}}
{{--                                </p>--}}

{{--                            </a>--}}

{{--                        </li>--}}

{{--                    @endcan--}}

                @endcanany


                {{-- =================================================
                     FINANCE
                ================================================== --}}

                @canany([
                    'finance.view',
                    'finance.approve',
                    'finance.reject',
                    'finance.budget.view',
                    'finance.budget.create',
                    'finance.budget.edit',
                    'finance.budget.delete'
                ])

                    <li class="nav-header">
                        FINANCE
                    </li>


                    {{-- Pending --}}

                    @can('finance.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('finance.pending') }}"
                                class="nav-link {{ request()->routeIs('finance.pending') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-hourglass-split"></i>

                                <p>
                                    Pending Validation
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Department Budget --}}

                    @canany([
                        'finance.budget.view',
                        'finance.budget.create',
                        'finance.budget.edit',
                        'finance.budget.delete'
                    ])

                        <li class="nav-item">

                            <a
                                href="{{ route('finance.department-budgets') }}"
                                class="nav-link {{ request()->routeIs('finance.department-budgets') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-wallet2"></i>

                                <p>
                                    Department Budget
                                </p>

                            </a>

                        </li>

                    @endcanany


                    {{-- Approved --}}

                    @can('finance.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('finance.approved') }}"
                                class="nav-link {{ request()->routeIs('finance.approved') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-check-circle"></i>

                                <p>
                                    Approved Requests
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Rejected --}}

                    @can('finance.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('finance.rejected') }}"
                                class="nav-link {{ request()->routeIs('finance.rejected') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-x-circle"></i>

                                <p>
                                    Rejected Requests
                                </p>

                            </a>

                        </li>

                    @endcan

                @endcanany


                {{-- =================================================
                     CEO
                ================================================== --}}

                @canany(['ceo.view', 'ceo.approve', 'ceo.reject'])

                    <li class="nav-header">
                        DG
                    </li>


                    {{-- Pending --}}

                    @can('ceo.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('ceo.pending') }}"
                                class="nav-link {{ request()->routeIs('ceo.pending') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-hourglass-split"></i>

                                <p>
                                    Pending Validation
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Approved --}}

                    @can('ceo.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('ceo.approved') }}"
                                class="nav-link {{ request()->routeIs('ceo.approved') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-check-circle"></i>

                                <p>
                                    Approved Requests
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Rejected --}}

                    @can('ceo.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('ceo.rejected') }}"
                                class="nav-link {{ request()->routeIs('ceo.rejected') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-x-circle"></i>

                                <p>
                                    Rejected Requests
                                </p>

                            </a>

                        </li>

                    @endcan

                @endcanany


                {{-- =================================================
                     EMPLOYEE MANAGEMENT
                ================================================== --}}

                @canany([
                    'employees.view',
                    'employees.create',
                    'employees.edit',
                    'employees.delete'
                ])

                    <li class="nav-header">
                        EMPLOYEE MANAGEMENT
                    </li>


                    {{-- Employees --}}

                    @can('employees.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('employees.index') }}"
                                class="nav-link {{
                                    request()->routeIs('employees.index') ||
                                    request()->routeIs('employees.show') ||
                                    request()->routeIs('employees.edit')
                                        ? 'active'
                                        : ''
                                }}"
                            >

                                <i class="nav-icon bi bi-people"></i>

                                <p>
                                    Employees
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Add Employee --}}

                    @can('employees.create')

                        <li class="nav-item">

                            <a
                                href="{{ route('employees.create') }}"
                                class="nav-link {{ request()->routeIs('employees.create') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-person-plus"></i>

                                <p>
                                    Add Employee
                                </p>

                            </a>

                        </li>

                    @endcan

                @endcanany


                {{-- =================================================
                     ORGANIZATION
                ================================================== --}}

                @canany([
                    'departments.view',
                    'departments.create',
                    'departments.edit',
                    'departments.delete'
                ])

                    <li class="nav-header">
                        ORGANIZATION
                    </li>


                    {{-- Departments --}}

                    @can('departments.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('departments.index') }}"
                                class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-diagram-3"></i>

                                <p>
                                    Departments
                                </p>

                            </a>

                        </li>

                    @endcan

                @endcanany


                {{-- =========================================================
     QUOTATIONS
========================================================== --}}

                @canany([
                    'quotations.view',
                    'quotations.create',
                    'quotations.edit',
                    'quotations.delete'
                ])

                    <li class="nav-header">
                        QUOTATIONS
                    </li>


                    {{-- Quotations --}}

                    @can('quotations.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('quotations.index') }}"
                                class="nav-link {{ request()->routeIs('quotations.index') || request()->routeIs('quotations.show') || request()->routeIs('quotations.edit') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-file-earmark-spreadsheet"></i>

                                <p>
                                    Quotations
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Add Quotation --}}

                    @can('quotations.create')

                        <li class="nav-item">

                            <a
                                href="{{ route('quotations.create') }}"
                                class="nav-link {{ request()->routeIs('quotations.create') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-file-earmark-plus"></i>

                                <p>
                                    Add Quotation
                                </p>

                            </a>

                        </li>

                    @endcan

                @endcanany


                @can('purchase_orders.view')
                    <li class="nav-item">
                        <a
                            href="{{ route('purchase-orders.index') }}"
                            class="nav-link {{ request()->routeIs('purchase-orders.index') ? 'active' : '' }}"
                        >
                            <i class="nav-icon bi bi-file-earmark-check"></i>

                            <p>
                                Purchase Orders
                            </p>
                        </a>
                    </li>
                @endcan




                @canany([
                    'users.view',
                    'users.create',
                    'users.edit',
                    'users.delete',
                    'roles.view',
                    'roles.create',
                    'roles.edit',
                    'roles.delete',
                    'permissions.view',
                    'permissions.create',
                    'permissions.edit',
                    'permissions.delete'
                ])

                    <li class="nav-header">
                        ADMINISTRATION
                    </li>


                    {{-- Users --}}

                    @can('users.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('users.index') }}"
                                class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-people"></i>

                                <p>
                                    Users
                                </p>

                            </a>

                        </li>

                    @endcan


                    {{-- Roles --}}

                    @can('roles.view')

                        <li class="nav-item">

                            <a
                                href="{{ route('roles.index') }}"
                                class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
                            >

                                <i class="nav-icon bi bi-shield-lock"></i>

                                <p>
                                    Roles
                                </p>

                            </a>

                        </li>

                    @endcan

                @endcanany


                {{-- =================================================
                     AUDIT
                ================================================== --}}

                @can('audit_logs.view')

                    <li class="nav-header">
                        AUDIT
                    </li>


                    <li class="nav-item">

                        <a
                            href="{{ route('audit-logs.index') }}"
                            class="nav-link {{ request()->routeIs('audit-logs.*') ? 'active' : '' }}"
                        >

                            <i class="nav-icon bi bi-journal-text"></i>

                            <p>
                                Audit Logs
                            </p>

                        </a>

                    </li>

                @endcan


                {{-- =================================================
                     ACCOUNT
                ================================================== --}}

                <li class="nav-header">
                    ACCOUNT
                </li>


                {{-- Profile --}}

                <li class="nav-item">

                    <a
                        href="#"
                        class="nav-link"
                    >

                        <i class="nav-icon bi bi-person"></i>

                        <p>
                            My Profile
                        </p>

                    </a>

                </li>


                {{-- Logout --}}

                <li class="nav-item">

                    <a
                        href="#"
                        class="nav-link"
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        "
                    >

                        <i class="nav-icon bi bi-box-arrow-right"></i>

                        <p>
                            Logout
                        </p>

                    </a>


                    <form
                        id="logout-form"
                        action="{{ route('logout') }}"
                        method="POST"
                        class="d-none"
                    >

                        @csrf

                    </form>

                </li>


            </ul>

        </nav>

    </div>

</aside>
