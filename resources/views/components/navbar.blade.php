<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <!--begin::Start Navbar Links-->
{{--        <ul class="navbar-nav">--}}

{{--            <!-- Sidebar Toggle -->--}}
{{--            <li class="nav-item">--}}
{{--                <a--}}
{{--                    class="nav-link"--}}
{{--                    data-lte-toggle="sidebar"--}}
{{--                    href="#"--}}
{{--                    role="button"--}}
{{--                    aria-label="Toggle sidebar"--}}
{{--                >--}}
{{--                    <i class="bi bi-list"></i>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <!-- Dashboard -->--}}
{{--            <li class="nav-item d-none d-md-block">--}}
{{--                <a href="{{ route('dashboard') }}" class="nav-link">--}}
{{--                    <i class="bi bi-speedometer2 me-1"></i>--}}
{{--                    Dashboard--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <!-- Employees -->--}}
{{--            <li class="nav-item d-none d-md-block">--}}
{{--                <a href="{{ route('employees.index') }}" class="nav-link">--}}
{{--                    <i class="bi bi-people me-1"></i>--}}
{{--                    Employees--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <!-- Departments -->--}}
{{--            <li class="nav-item d-none d-md-block">--}}
{{--                <a href="{{ route('departments.index') }}" class="nav-link">--}}
{{--                    <i class="bi bi-diagram-3 me-1"></i>--}}
{{--                    Organization--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}
        <!--end::Start Navbar Links-->


        <!--begin::Navbar Search-->
{{--        <form--}}
{{--            class="navbar-search d-none d-md-block ms-3"--}}
{{--            role="search"--}}
{{--            action="#"--}}
{{--        >--}}
{{--            <label for="navbar-search-input" class="visually-hidden">--}}
{{--                Search--}}
{{--            </label>--}}

{{--            <div class="navbar-search-field">--}}
{{--                <input--}}
{{--                    type="search"--}}
{{--                    id="navbar-search-input"--}}
{{--                    name="q"--}}
{{--                    class="form-control"--}}
{{--                    placeholder="Search employee, department..."--}}
{{--                    autocomplete="off"--}}
{{--                />--}}

{{--                <button--}}
{{--                    class="navbar-search-submit"--}}
{{--                    type="submit"--}}
{{--                    aria-label="Submit search"--}}
{{--                >--}}
{{--                    <i class="bi bi-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </form>--}}
        <!--end::Navbar Search-->


        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">

            <!-- Mobile Search -->
            <li class="nav-item d-md-none">
                <a
                    class="nav-link"
                    href="#"
                    aria-label="Search"
                >
                    <i class="bi bi-search"></i>
                </a>
            </li>


            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a
                    class="nav-link"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-label="Notifications"
                >
                    <i class="bi bi-bell"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                    <span class="dropdown-item dropdown-header">
                        HR Notifications
                    </span>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-person-plus me-2"></i>
                        New employee
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-calendar-event me-2"></i>
                        Upcoming event
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        HR report available
                    </a>

                </div>
            </li>


            <!-- Language -->
            <li class="nav-item dropdown">

                <a
                    class="nav-link"
                    href="#"
                    id="language-menu"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    aria-label="Change language"
                >
                    <i class="bi bi-translate"></i>
                </a>

                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="language-menu"
                >

                    <li>
                        <a class="dropdown-item active" href="#">
                            Français
                            <i class="bi bi-check-lg ms-2"></i>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            English
                        </a>
                    </li>

                </ul>
            </li>


            <!-- Fullscreen -->
            <li class="nav-item">
                <a
                    class="nav-link"
                    href="#"
                    data-lte-toggle="fullscreen"
                    aria-label="Toggle fullscreen"
                >
                    <i
                        data-lte-icon="maximize"
                        class="bi bi-arrows-fullscreen"
                    ></i>

                    <i
                        data-lte-icon="minimize"
                        class="bi bi-fullscreen-exit d-none"
                    ></i>
                </a>
            </li>


            <!-- Color Mode -->
            <li class="nav-item dropdown">

                <a
                    class="nav-link"
                    href="#"
                    id="bd-theme"
                    aria-label="Toggle color scheme"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i
                        class="bi bi-sun-fill"
                        data-lte-theme-icon="light"
                    ></i>

                    <i
                        class="bi bi-moon-fill d-none"
                        data-lte-theme-icon="dark"
                    ></i>

                    <i
                        class="bi bi-circle-half d-none"
                        data-lte-theme-icon="auto"
                    ></i>
                </a>

                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="bd-theme"
                    style="--bs-dropdown-min-width: 8rem"
                >

                    <li>
                        <button
                            type="button"
                            class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="light"
                        >
                            <i class="bi bi-sun-fill me-2"></i>
                            Light
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>

                    <li>
                        <button
                            type="button"
                            class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="dark"
                        >
                            <i class="bi bi-moon-fill me-2"></i>
                            Dark
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>

                    <li>
                        <button
                            type="button"
                            class="dropdown-item d-flex align-items-center active"
                            data-bs-theme-value="auto"
                        >
                            <i class="bi bi-circle-half me-2"></i>
                            Auto
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>

                </ul>
            </li>


            <!--begin::User Menu-->
            @auth
                <li class="nav-item dropdown user-menu">

                    <a
                        href="#"
                        class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown"
                    >

                        <img
                            src="{{ asset('assets/img/default-user.png') }}"
                            class="user-image rounded-circle shadow"
                            alt="{{ auth()->user()->name }}"
                        />

                        <span class="d-none d-md-inline">
                            {{ auth()->user()->name }}
                        </span>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                        <!-- User Header -->
                        <li class="user-header text-bg-primary">

                            <img
                                src="{{ asset('assets/img/default-user.png') }}"
                                class="rounded-circle shadow"
                                alt="{{ auth()->user()->name }}"
                            />

                            <p>
                                {{ auth()->user()->name }}

                                <small>
                                    {{ auth()->user()->email }}
                                </small>
                            </p>

                        </li>

                        <!-- User Body -->
                        <li class="user-body">

                            <div class="row">

                                <div class="col-4 text-center">
                                    <a href="{{ route('employees.index') }}">
                                        Employees
                                    </a>
                                </div>

                                <div class="col-4 text-center">
                                    <a href="{{ route('departments.index') }}">
                                        Departments
                                    </a>
                                </div>

                                <div class="col-4 text-center">
                                    <a href="#">
                                        Profile
                                    </a>
                                </div>

                            </div>

                        </li>

                        <!-- User Footer -->
                        <li class="user-footer">

                            <a
                                href="#"
                                class="btn btn-outline-secondary"
                            >
                                <i class="bi bi-person me-1"></i>
                                Profile
                            </a>

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                                class="float-end"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger"
                                >
                                    <i class="bi bi-box-arrow-right me-1"></i>
                                    Logout
                                </button>
                            </form>

                        </li>

                    </ul>
                </li>
            @endauth
            <!--end::User Menu-->

        </ul>
        <!--end::End Navbar Links-->

    </div>
</nav>
