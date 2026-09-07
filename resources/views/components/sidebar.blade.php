
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- =========================================================
         BRAND
    ========================================================== --}}

    <div class="sidebar-brand">

        <a href="{{ url('/') }}" class="brand-link">

            <span class="brand-text fw-light">
                AMC SARL
            </span>

        </a>

    </div>


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
                        href="{{ url('/') }}"
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

                <li class="nav-header">
                    REQUESTS
                </li>


                {{-- All requests accessible to the user --}}

                <li class="nav-item">

                    <a
                        href="{{ route('requests.index') }}"
                        class="nav-link {{ request()->routeIs('requests.*') ? 'active' : '' }}"
                    >

                        <i class="nav-icon bi bi-file-earmark-text"></i>

                        <p>
                            Requests
                        </p>

                    </a>

                </li>

                {{-- =================================================
                     PROCUREMENT
                ================================================== --}}





                <li class="nav-header">
                    PROCUREMENT
                </li>

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



                {{-- Approved requests --}}

                <li class="nav-item">

                    <a
                        href="{{ route('requests.approved') }}"
                        class="nav-link {{ request()->routeIs('requests.approved') ? 'active' : '' }}"
                    >

                        <i class="nav-icon bi bi-check-circle"></i>

                        <p>
                            Approved Requests
                        </p>

                    </a>

                </li>




                <li class="nav-item">

                    <a
                        href="{{ route('procurement.requests.rejected') }}"
                        class="nav-link {{ request()->routeIs('procurement.requests.rejected') ? 'active' : '' }}"
                    >

                        <i class="nav-icon bi bi-x-circle"></i>

                        <p>
                            Rejected Requests
                        </p>

                    </a>

                </li>






                {{-- =================================================
                     EMPLOYEE MANAGEMENT
                ================================================== --}}

                <li class="nav-header">
                    EMPLOYEE MANAGEMENT
                </li>


                {{-- Employees --}}

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


                {{-- Add employee --}}

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


                {{-- =================================================
                     ORGANIZATION
                ================================================== --}}

                <li class="nav-header">
                    ORGANIZATION
                </li>


                {{-- Departments --}}

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


                {{-- =================================================
                     ADMINISTRATION
                ================================================== --}}



                <li class="nav-header">
                    ADMINISTRATION
                </li>


                {{-- Users --}}



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




                {{-- Roles --}}

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




                {{-- =================================================
                     AUDIT
                ================================================== --}}



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
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
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

