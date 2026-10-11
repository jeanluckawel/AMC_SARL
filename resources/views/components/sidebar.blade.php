```blade
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- =========================================================
         BRAND
    ========================================================== --}}

    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">

            <img
                src="{{ asset('logo/logo.png') }}"
                alt="Logo AMC SARL"
                class="brand-image-custom"
            >

            <span class="brand-text">AMC SARL</span>

        </a>
    </div>

    <style>
        /* BRAND : même fond que la sidebar */
        .app-sidebar .sidebar-brand {
            background-color: var(--lte-sidebar-bg, var(--bs-secondary-bg)) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .app-sidebar .sidebar-brand .brand-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            min-height: 65px;
            text-decoration: none;
        }

        .app-sidebar .brand-image-custom {
            width: 38px;
            height: 38px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .app-sidebar .sidebar-brand .brand-text {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: .3px;
        }
    </style>

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

                {{-- MAIN MENU --}}

                <li class="nav-header">
                    {{ __('menu.main_menu') }}
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                    >
                        <i class="nav-icon bi bi-speedometer icon-dashboard"></i>
                        <p>{{ __('menu.dashboard') }}</p>
                    </a>
                </li>

                {{-- REQUESTS --}}

                @can('requests.view')

                    <li class="nav-header">
                        {{ __('menu.requests') }}
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('requests.index') }}"
                            class="nav-link {{ request()->routeIs('requests.index') ? 'active' : '' }}"
                        >
                            <i class="nav-icon bi bi-file-earmark-text icon-requests"></i>
                            <p>{{ __('menu.requests') }}</p>
                        </a>
                    </li>

                @endcan

                {{-- PROCUREMENT --}}

                @canany([
                    'procurement.view',
                    'procurement.approve',
                    'procurement.reject'
                ])

                    <li class="nav-header">
                        {{ __('menu.procurement') }}
                    </li>

                    @can('procurement.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('procurement.pending') }}"
                                class="nav-link {{ request()->routeIs('procurement.pending') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-hourglass-split icon-procurement"></i>
                                <p>{{ __('menu.pending_validation') }}</p>
                            </a>
                        </li>

                    @endcan

                    {{-- Approved
                    @can('procurement.view')
                        <li class="nav-item">
                            <a
                                href="{{ route('requests.approved') }}"
                                class="nav-link {{ request()->routeIs('requests.approved') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-check-circle icon-procurement"></i>
                                <p>Approved Requests</p>
                            </a>
                        </li>
                    @endcan
                    --}}

                    {{-- Rejected
                    @can('procurement.view')
                        <li class="nav-item">
                            <a
                                href="{{ route('procurement.requests.rejected') }}"
                                class="nav-link {{ request()->routeIs('procurement.requests.rejected') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-x-circle icon-procurement"></i>
                                <p>Rejected Requests</p>
                            </a>
                        </li>
                    @endcan
                    --}}

                @endcanany

                {{-- FINANCE --}}

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
                        {{ __('menu.finance') }}
                    </li>

                    @can('finance.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('finance.pending') }}"
                                class="nav-link {{ request()->routeIs('finance.pending') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-hourglass-split icon-finance"></i>
                                <p>{{ __('menu.pending_validation') }}</p>
                            </a>
                        </li>

                    @endcan

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
                                <i class="nav-icon bi bi-wallet2 icon-finance"></i>
                                <p>{{ __('menu.department_budget') }}</p>
                            </a>
                        </li>

                    @endcanany

                    @can('finance.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('finance.approved') }}"
                                class="nav-link {{ request()->routeIs('finance.approved') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-check-circle icon-finance"></i>
                                <p>{{ __('menu.approved_requests') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('finance.rejected') }}"
                                class="nav-link {{ request()->routeIs('finance.rejected') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-x-circle icon-finance"></i>
                                <p>{{ __('menu.rejected_requests') }}</p>
                            </a>
                        </li>

                    @endcan

                @endcanany

                {{-- CEO --}}

                @canany([
                    'ceo.view',
                    'ceo.approve',
                    'ceo.reject'
                ])

                    <li class="nav-header">
                        {{ __('menu.ceo') }}
                    </li>

                    @can('ceo.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('ceo.pending') }}"
                                class="nav-link {{ request()->routeIs('ceo.pending') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-hourglass-split icon-ceo"></i>
                                <p>{{ __('menu.pending_validation') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('ceo.approved') }}"
                                class="nav-link {{ request()->routeIs('ceo.approved') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-check-circle icon-ceo"></i>
                                <p>{{ __('menu.approved_requests') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{ route('ceo.rejected') }}"
                                class="nav-link {{ request()->routeIs('ceo.rejected') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-x-circle icon-ceo"></i>
                                <p>{{ __('menu.rejected_requests') }}</p>
                            </a>
                        </li>

                    @endcan

                @endcanany

                {{-- EMPLOYEE MANAGEMENT --}}

                @canany([
                    'employees.view',
                    'employees.create',
                    'employees.edit',
                    'employees.delete'
                ])

                    <li class="nav-header">
                        {{ __('menu.employee_management') }}
                    </li>

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
                                <i class="nav-icon bi bi-people icon-employees"></i>
                                <p>{{ __('menu.employees') }}</p>
                            </a>
                        </li>

                    @endcan

                    @can('employees.create')

                        <li class="nav-item">
                            <a
                                href="{{ route('employees.create') }}"
                                class="nav-link {{ request()->routeIs('employees.create') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-person-plus icon-employees"></i>
                                <p>{{ __('menu.add_employee') }}</p>
                            </a>
                        </li>

                    @endcan

                @endcanany

                {{-- PAYROLL MANAGEMENT --}}

                <li class="nav-header">
                    {{ __('menu.payroll_management') }}
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('payroll.index') }}"
                        class="nav-link {{
                            request()->routeIs('payroll.index') ||
                            request()->routeIs('payroll.show') ||
                            request()->routeIs('payroll.edit')
                                ? 'active'
                                : ''
                        }}"
                    >
                        <i class="nav-icon bi bi-cash-stack icon-payroll"></i>
                        <p>{{ __('menu.payroll') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('payroll.payslips') }}"
                        class="nav-link {{ request()->routeIs('payroll.payslips') ? 'active' : '' }}"
                    >
                        <i class="nav-icon bi bi-receipt icon-payroll"></i>
                        <p>All Payslips</p>
                    </a>
                </li>

                {{-- ORGANIZATION --}}

                @canany([
                    'departments.view',
                    'departments.create',
                    'departments.edit',
                    'departments.delete'
                ])

                    <li class="nav-header">
                        {{ __('menu.organization') }}
                    </li>

                    @can('departments.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('departments.index') }}"
                                class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-diagram-3 icon-organization"></i>
                                <p>{{ __('menu.departments') }}</p>
                            </a>
                        </li>

                    @endcan

                @endcanany

                {{-- QUOTATIONS --}}

                @canany([
                    'quotations.view',
                    'quotations.create',
                    'quotations.edit',
                    'quotations.delete'
                ])

                    <li class="nav-header">
                        {{ __('menu.quotations') }}
                    </li>

                    @can('quotations.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('quotations.index') }}"
                                class="nav-link {{
                                    request()->routeIs('quotations.index') ||
                                    request()->routeIs('quotations.show') ||
                                    request()->routeIs('quotations.edit')
                                        ? 'active'
                                        : ''
                                }}"
                            >
                                <i class="nav-icon bi bi-file-earmark-spreadsheet icon-quotations"></i>
                                <p>{{ __('menu.quotations') }}</p>
                            </a>
                        </li>

                    @endcan

                    @can('quotations.create')

                        <li class="nav-item">
                            <a
                                href="{{ route('quotations.create') }}"
                                class="nav-link {{ request()->routeIs('quotations.create') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-file-earmark-plus icon-quotations"></i>
                                <p>{{ __('menu.add_quotation') }}</p>
                            </a>
                        </li>

                    @endcan

                @endcanany

                {{-- PURCHASE ORDERS --}}

                @can('purchase_orders.view')

                    <li class="nav-item">
                        <a
                            href="{{ route('purchase-orders.index') }}"
                            class="nav-link {{ request()->routeIs('purchase-orders.index') ? 'active' : '' }}"
                        >
                            <i class="nav-icon bi bi-file-earmark-check icon-purchase-orders"></i>
                            <p>{{ __('menu.purchase_orders') }}</p>
                        </a>
                    </li>

                @endcan

                {{-- ADMINISTRATION --}}

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
                        {{ __('menu.administration') }}
                    </li>

                    @can('users.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('users.index') }}"
                                class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-people icon-administration"></i>
                                <p>{{ __('menu.users') }}</p>
                            </a>
                        </li>

                    @endcan

                    @can('roles.view')

                        <li class="nav-item">
                            <a
                                href="{{ route('roles.index') }}"
                                class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
                            >
                                <i class="nav-icon bi bi-shield-lock icon-administration"></i>
                                <p>{{ __('menu.roles') }}</p>
                            </a>
                        </li>

                    @endcan

                @endcanany

                {{-- AUDIT --}}

                @can('audit_logs.view')

                    <li class="nav-header">
                        {{ __('menu.audit') }}
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('audit-logs.index') }}"
                            class="nav-link {{ request()->routeIs('audit-logs.*') ? 'active' : '' }}"
                        >
                            <i class="nav-icon bi bi-journal-text icon-audit"></i>
                            <p>{{ __('menu.audit_logs') }}</p>
                        </a>
                    </li>

                @endcan

                {{-- ACCOUNT --}}

                <li class="nav-header">
                    {{ __('menu.account') }}
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('employees.myProfile') }}"
                        class="nav-link {{ request()->routeIs('employees.myProfile') ? 'active' : '' }}"
                    >
                        <i class="nav-icon bi bi-person icon-account"></i>
                        <p>{{ __('menu.my_profile') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="#"
                        class="nav-link"
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        "
                    >
                        <i class="nav-icon bi bi-box-arrow-right icon-account"></i>
                        <p>{{ __('menu.logout') }}</p>
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

<style>
    /* =========================================================
       BRAND
    ========================================================= */

    .sidebar-brand {
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
    }

    .sidebar-brand .brand-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        min-height: 65px;
        text-decoration: none;
    }

    .brand-image-custom {
        width: 38px;
        height: 38px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .sidebar-brand .brand-text {
        color: #212529;
        font-size: 17px;
        font-weight: 700 !important;
        letter-spacing: .3px;
    }

    /* =========================================================
       BASE ICON STYLE
    ========================================================= */

    .app-sidebar .nav-link .nav-icon {
        width: 1.5rem;
        margin-right: .35rem;
        font-size: 1.05rem;
        text-align: center;
        transition: color .2s ease, transform .2s ease;
    }

    .app-sidebar .nav-link:hover .nav-icon {
        transform: translateX(2px);
    }

    /* =========================================================
       SECTION COLORS
    ========================================================= */

    /* Dashboard — Blue */
    .icon-dashboard {
        color: #60a5fa !important;
    }

    /* Requests — Cyan */
    .icon-requests {
        color: #22d3ee !important;
    }

    /* Procurement — Orange */
    .icon-procurement {
        color: #fb923c !important;
    }

    /* Finance — Green */
    .icon-finance {
        color: #4ade80 !important;
    }

    /* CEO — Purple */
    .icon-ceo {
        color: #c084fc !important;
    }

    /* Employee Management — Light Blue */
    .icon-employees {
        color: #38bdf8 !important;
    }

    /* Payroll — Emerald */
    .icon-payroll {
        color: #34d399 !important;
    }

    /* Organization — Turquoise */
    .icon-organization {
        color: #2dd4bf !important;
    }

    /* Quotations — Yellow */
    .icon-quotations {
        color: #facc15 !important;
    }

    /* Purchase Orders — Indigo */
    .icon-purchase-orders {
        color: #818cf8 !important;
    }

    /* Administration — Pink */
    .icon-administration {
        color: #f472b6 !important;
    }

    /* Audit — Gray */
    .icon-audit {
        color: #d1d5db !important;
    }

    /* Account — White */
    .icon-account {
        color: #e5e7eb !important;
    }

    /* =========================================================
       HOVER COLORS — KEEP SECTION IDENTITY
    ========================================================= */

    .app-sidebar .nav-link:hover .icon-dashboard {
        color: #93c5fd !important;
    }

    .app-sidebar .nav-link:hover .icon-requests {
        color: #67e8f9 !important;
    }

    .app-sidebar .nav-link:hover .icon-procurement {
        color: #fdba74 !important;
    }

    .app-sidebar .nav-link:hover .icon-finance {
        color: #86efac !important;
    }

    .app-sidebar .nav-link:hover .icon-ceo {
        color: #d8b4fe !important;
    }

    .app-sidebar .nav-link:hover .icon-employees {
        color: #7dd3fc !important;
    }

    .app-sidebar .nav-link:hover .icon-payroll {
        color: #6ee7b7 !important;
    }

    .app-sidebar .nav-link:hover .icon-organization {
        color: #5eead4 !important;
    }

    .app-sidebar .nav-link:hover .icon-quotations {
        color: #fde047 !important;
    }

    .app-sidebar .nav-link:hover .icon-purchase-orders {
        color: #a5b4fc !important;
    }

    .app-sidebar .nav-link:hover .icon-administration {
        color: #f9a8d4 !important;
    }

    .app-sidebar .nav-link:hover .icon-audit {
        color: #f3f4f6 !important;
    }

    .app-sidebar .nav-link:hover .icon-account {
        color: #ffffff !important;
    }

    /* =========================================================
       ACTIVE LINKS
    ========================================================= */

    .app-sidebar .nav-link.active {
        font-weight: 600;
    }

    .app-sidebar .nav-link.active .nav-icon {
        filter: brightness(1.15);
    }

    /* Keep the colored icons visible on the dark sidebar */
    .app-sidebar[data-bs-theme="dark"] .nav-link .nav-icon {
        opacity: 1;
    }
</style>
```
