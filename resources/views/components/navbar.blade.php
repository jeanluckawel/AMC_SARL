<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

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
            <!-- Language -->
            <li class="nav-item dropdown">

                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="language-menu"
                    role="button"
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

                    {{-- FRANÇAIS --}}
                    <li>
                        <a
                            class="dropdown-item d-flex align-items-center justify-content-between {{ app()->getLocale() === 'fr' ? 'active' : '' }}"
                            href="{{ route('language.switch', 'fr') }}"
                        >

                <span>
                    <span class="me-2">🇫🇷</span>
                    Français
                </span>

                            @if(app()->getLocale() === 'fr')
                                <i class="bi bi-check-lg ms-2"></i>
                            @endif

                        </a>
                    </li>


                    {{-- ENGLISH --}}
                    <li>
                        <a
                            class="dropdown-item d-flex align-items-center justify-content-between {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                            href="{{ route('language.switch', 'en') }}"
                        >

                <span>
                    <span class="me-2">🇬🇧</span>
                    English
                </span>

                            @if(app()->getLocale() === 'en')
                                <i class="bi bi-check-lg ms-2"></i>
                            @endif

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

                @php
                    $userName = trim(auth()->user()->name ?? '');
                    $nameParts = preg_split('/\s+/', $userName);

                    if (count($nameParts) >= 2) {
                        $initials = strtoupper(
                            substr($nameParts[0], 0, 1) .
                            substr($nameParts[count($nameParts) - 1], 0, 1)
                        );
                    } else {
                        $initials = strtoupper(substr($userName, 0, 2));
                    }

                    if ($initials === '') {
                        $initials = '??';
                    }
                @endphp


                <li class="nav-item dropdown user-menu">

                    <a
                        href="#"
                        class="nav-link dropdown-toggle d-flex align-items-center"
                        data-bs-toggle="dropdown"
                    >

                        <!-- User Initials -->
                        <span
                            class="user-initials"
                            title="{{ auth()->user()->name }}"
                        >
                            {{ $initials }}
                        </span>

                        <!-- User Name -->
                        <span class="d-none d-md-inline ms-2">
                            {{ auth()->user()->name }}
                        </span>

                    </a>


                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">


                        <!-- User Header -->
                        <li class="user-header text-bg-primary">

                            <!-- Large Initials -->
                            <div class="profile-initials">
                                {{ $initials }}
                            </div>

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

                                    <a href="{{ route('employees.myProfile') }}">
                                        Profile
                                    </a>

                                </div>

                            </div>

                        </li>


                        <!-- User Footer -->
                        <li class="user-footer">

                            <a
                                href="{{ route('employees.myProfile') }}"
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


<style>

    /* User initials in navbar */
    .user-initials {
        width: 38px;
        height: 38px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #FF6600;
        color: #ffffff;

        font-size: 13px;
        font-weight: 700;

        text-transform: uppercase;

        flex-shrink: 0;
    }


    /* Large initials inside dropdown */
    .profile-initials {
        width: 75px;
        height: 75px;

        margin: 0 auto 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #FF6600;
        color: #ffffff;

        border: 3px solid rgba(255, 255, 255, 0.35);

        font-size: 25px;
        font-weight: 700;

        text-transform: uppercase;
    }


    /* User header */
    .user-menu .user-header {
        text-align: center;
        padding: 20px;
    }


    .user-menu .user-header p {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }


    .user-menu .user-header small {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        font-weight: 400;
        opacity: .85;
    }


    /* User body */
    .user-menu .user-body {
        padding: 15px 10px;
    }


    .user-menu .user-body a {
        color: #495057;
        text-decoration: none;
        font-size: 12px;
    }


    .user-menu .user-body a:hover {
        color: #FF6600;
    }


    /* User footer */
    .user-menu .user-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
    }


    /* Mobile */
    @media (max-width: 576px) {

        .user-menu .dropdown-menu {
            width: 280px;
        }

        .user-menu .user-footer {
            gap: 10px;
        }

        .user-menu .user-footer .btn {
            font-size: 12px;
        }

    }

</style>
