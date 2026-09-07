<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Sidebar Mini</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Sidebar Mini" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="../css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
<!--begin::App Wrapper-->
<div class="app-wrapper">

    @include('components.navbar')

    @include('components.sidebar')
    <!--begin::App Main-->

    <main class="app-main">

        <style>
            * {
                box-sizing: border-box;
            }

            @page {
                size: A4;
                margin: 0;
            }

            html,
            body {
                margin: 0;
                background: #eee;
            }

            body {
                font-family: sans-serif;
                color: #111;
            }


            /* =====================================================
               PAGE
            ===================================================== */

            .page {
                width: 210mm;
                min-height: 297mm;
                margin: 12px auto;
                background: #fff;
                position: relative;
                padding: 12mm 12mm 18mm;
                overflow: hidden;
            }

            .content {
                position: relative;
                z-index: 1;
            }


            /* =====================================================
               HEADER
            ===================================================== */

            .top {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 14mm;
                min-height: 53mm;
            }

            .brand {
                display: flex;
                align-items: flex-start;
                gap: 7px;
            }

            .logo {
                width: 39mm;
                height: 25mm;
                border: 3px solid #555;
                border-right-color: transparent;
                border-bottom-color: transparent;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                margin-top: 1mm;
            }

            .logo b {
                font-size: 23px;
                font-style: italic;
                color: #555;
                letter-spacing: -2px;
            }

            .logo small {
                position: absolute;
                top: 17mm;
                left: 8mm;
                font-size: 6px;
                font-weight: 700;
                color: #555;
            }

            .logo:after {
                content: "";
                position: absolute;
                width: 9mm;
                height: 5mm;
                border-radius: 70% 20%;
                border-top: 5px solid #e31b23;
                transform: rotate(-25deg);
                left: 12mm;
                top: 22mm;
            }

            .left-meta {
                margin-top: 2mm;
                font-size: 11.2px;
                line-height: 1.28;
            }

            .left-meta .blue {
                color: #0879c9;
                text-decoration: underline;
            }

            .address {
                font-size: 12px;
                line-height: 1.27;
            }

            .rule {
                height: 1px;
                background: #f47721;
                margin: 2mm 10mm 3mm;
            }


            /* =====================================================
               TITLE
            ===================================================== */

            .title-row {
                display: grid;
                grid-template-columns: 2fr 1fr;
                border: 1px solid #222;
                height: 9mm;
            }

            .title {
                background: #4f8136;
                color: #000;
                font-size: 17px;
                font-weight: 800;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .date {
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 11.5px;
            }

            .client-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1mm;
                font-size: 11px;
            }

            .quote-no {
                font-weight: 700;
                margin-top: 2mm;
                text-align: right;
                font-size: 11px;
            }


            /* =====================================================
               TABLE
            ===================================================== */

            table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
                margin-top: 1mm;
                font-size: 10.5px;
            }

            th,
            td {
                border: 1px solid #222;
                padding: 2.8mm 1.2mm;
                vertical-align: middle;
            }

            th {
                background: #d9d9d9;
                text-align: center;
                font-weight: 800;
            }

            th:nth-child(1) {
                width: 5.8%;
            }

            th:nth-child(2) {
                width: 59%;
            }

            th:nth-child(3) {
                width: 8%;
            }

            th:nth-child(4) {
                width: 7%;
            }

            th:nth-child(5) {
                width: 9%;
            }

            th:nth-child(6) {
                width: 11.2%;
            }

            td:nth-child(1),
            td:nth-child(3),
            td:nth-child(4),
            td:nth-child(5),
            td:nth-child(6) {
                text-align: center;
            }

            td:nth-child(5),
            td:nth-child(6) {
                text-align: right;
                padding-right: 2mm;
            }


            /* =====================================================
               TOTAL
            ===================================================== */

            .subtotal {
                margin-top: 5mm;
                display: grid;
                grid-template-columns: 1fr 58mm;
                align-items: stretch;
            }

            .sub-label {
                background: #d9d9d9;
                border: 1px solid #222;
                border-right: 0;
                font-weight: 800;
                text-align: center;
                padding: 1mm;
                font-size: 14px;
            }

            .money {
                border: 1px solid #222;
                font-size: 12px;
            }

            .money-row {
                display: grid;
                grid-template-columns: 1fr 1.25fr;
            }

            .money-row > div {
                border-bottom: 1px solid #222;
                padding: 1mm;
            }

            .money-row:last-child > div {
                border-bottom: 0;
            }

            .money-row .label {
                font-weight: 800;
                text-align: center;
            }

            .money-row .val {
                text-align: right;
                font-weight: 800;
                padding-right: 4mm;
            }


            /* =====================================================
               APPROVAL WORKFLOW
            ===================================================== */

            .lower {
                width: 100%;
                margin-top: 10mm;
            }

            .approvals-section {
                width: 92%;
                margin: 0 auto;
            }

            .approval-title {
                width: 100%;
                font-size: 11pt;
                font-weight: 700;
                text-transform: uppercase;
                /*text-align: center;*/
                border-bottom: 1px solid #222;
                padding-bottom: 3mm;
                margin-bottom: 5mm;
            }

            /*
             * Les trois blocs sont sur une seule ligne.
             * La largeur est divisée équitablement.
             */
            .approvals {
                width: 100%;
                display: table;
                table-layout: fixed;
                border-collapse: separate;

                /*
                 * Même espace entre Procurement / Finance / CEO
                 */
                border-spacing: 5mm 0;
            }

            .approval-box {
                display: table-cell;
                width: 33.333%;
                vertical-align: top;

                border: 1px solid #cfcfcf;

                padding: 4mm;

                height: 24mm;

                background: #fff;

                text-align: center;
            }

            .approval-role {
                font-size: 9pt;
                font-weight: 700;
                text-transform: uppercase;
                margin-bottom: 4mm;
                color: #222;
            }

            .approval-status {
                font-size: 9pt;
                font-weight: 700;
                text-align: center;
                color: #198754;
            }

            .approval-status.rejected {
                color: #dc3545;
            }

            .approval-status.pending {
                color: #6c757d;
            }

            .approval-status i {
                font-size: 9pt;
                margin-right: 2px;
            }


            /* =====================================================
               FOOTER
            ===================================================== */

            .footer {
                position: absolute;
                left: 25mm;
                right: 25mm;
                bottom: 22mm;
                border-top: 1px solid #f47721;
                padding-top: 2mm;
                font-size: 8px;
            }

            .footer b {
                display: inline-block;
                width: 24mm;
            }

            .note {
                font-size: 8px;
                color: #8b0000;
                text-align: center;
                margin-top: 2mm;
                font-weight: 700;
            }


            /* =====================================================
               PRINT
            ===================================================== */

            @media print {

                html,
                body {
                    background: #fff;
                }

                .page {
                    margin: 0;
                    box-shadow: none;
                }
            }
        </style>


        <div class="page">

            <div class="content">


                <!-- =================================================
                     HEADER
                ================================================== -->

                <section class="top">

                    <div>

                        <div class="brand">

                            <div class="logo">
                                <b>AMC</b>
                                <small>AFRICA COMPANY</small>
                            </div>

                        </div>


                        <div class="left-meta">

                            RCCM : CD/LSH/RCCM/21-B-00395<br>
                            Id. Nat: 05-F4300-N77755L<br>
                            NIF: A2158758R<br>
                            TVA : 6634/2022<br>
                            ARSP : 4885676212<br>
                            Tél. : +243 970 520 222<br>

                            Email:
                            <span class="blue">
                            info@amc-sarl.com
                        </span>

                        </div>

                    </div>


                    <div class="address">

                        <div>[SITE / ENTREPÔT]</div>
                        <div>[ADRESSE]</div>
                        <div>[VILLE, PROVINCE]</div>
                        <div>[PAYS]</div>

                        <br>

                        <div>Tél: [TÉLÉPHONE]</div>
                        <div>[ADRESSE COMPLÉMENTAIRE]</div>

                    </div>

                </section>


                <div class="rule"></div>


                <!-- =================================================
                     REQUEST TITLE
                ================================================== -->

                <div class="title-row">

                    <div class="title">
                        REQUEST : {{ $requestModel->reference ?? '-' }}
                    </div>

                    <div class="date">
                        Kolwezi,
                        {{ $requestModel->created_at?->format('d/m/Y') ?? '-' }}
                    </div>

                </div>


                <div class="client-row">

                    <div>
                        Client:
                        <strong>
                            {{ $requestModel->id }}
                        </strong>
                    </div>

                </div>


                <div class="quote-no">
                    QUOTE {{ $requestModel->reference ?? '-' }}
                </div>


                <!-- =================================================
                     ITEMS
                ================================================== -->

                <table>

                    <thead>

                    <tr>

                        <th>
                            Line<br>N°
                        </th>

                        <th>
                            Item Number / Description
                        </th>

                        <th>
                            Quantity
                        </th>

                        <th>
                            U/M
                        </th>

                        <th>
                            Unit<br>Price
                        </th>

                        <th>
                            Currency
                        </th>

                    </tr>

                    </thead>


                    <tbody>

                    @forelse($requestModel->items as $index => $item)

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>


                            <td>
                                {{ $item->name }}
                            </td>


                            <td>

                                {{ rtrim(
                                    rtrim(
                                        number_format(
                                            $item->quantity,
                                            2,
                                            '.',
                                            ''
                                        ),
                                        '0'
                                    ),
                                    '.'
                                ) }}

                            </td>


                            <td>
                                {{ $item->unit ?: '-' }}
                            </td>


                            <td>

                                @if($item->unit_price !== null)

                                    {{ number_format(
                                        $item->unit_price,
                                        2,
                                        '.',
                                        ','
                                    ) }}

                                @else

                                    -

                                @endif

                            </td>


                            <td>

                                @if($item->total_price !== null)

                                    {{ number_format(
                                        $item->total_price,
                                        2,
                                        '.',
                                        ','
                                    ) }}

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                style="text-align:center;"
                            >
                                No items found.
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>


                <!-- =================================================
                     TOTALS
                ================================================== -->

                <div class="subtotal">

                    <div class="sub-label">
                        SUB TOTAL
                    </div>


                    <div class="money">

                        <div class="money-row">

                            <div class="label">
                                $
                            </div>

                            <div class="val">

                                {{ number_format(
                                    $requestModel->total_amount,
                                    2,
                                    '.',
                                    ','
                                ) }}

                            </div>

                        </div>


                        <div class="money-row">

                            <div class="label">
                                VAT 16%
                            </div>

                            <div class="val">

                                $ &nbsp;

                                {{ number_format(
                                    ($requestModel->total_amount * 16) / 100,
                                    2,
                                    '.',
                                    ','
                                ) }}

                            </div>

                        </div>


                        <div class="money-row">

                            <div class="label">
                                TOTAL
                            </div>

                            <div class="val">

                                $ &nbsp;

                                {{ number_format(
                                    $requestModel->total_amount +
                                    (($requestModel->total_amount * 16) / 100),
                                    2,
                                    '.',
                                    ','
                                ) }}

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     APPROVAL WORKFLOW
                ================================================== -->

                <section class="lower">

                    <div class="approvals-section">

                        <div class="approval-title">
                            Approval
                        </div>


                        <div class="approvals">


                            {{-- PROCUREMENT --}}

                            @php
                                $procurementStep = $requestModel->steps
                                    ->firstWhere('step.value', 'procurement');
                            @endphp


                            <div class="approval-box">

                                <div class="approval-role">
                                    Procurement
                                </div>


                                @if($procurementStep)

                                    @if($procurementStep->decision->value === 'approved')

                                        <div class="approval-status">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approved

                                        </div>

                                    @else

                                        <div class="approval-status rejected">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Rejected

                                        </div>

                                    @endif

                                @else

                                    <div class="approval-status pending">

                                        <i class="bi bi-clock me-1"></i>

                                        Pending

                                    </div>

                                @endif

                            </div>


                            {{-- FINANCE --}}

                            @php
                                $financeStep = $requestModel->steps
                                    ->firstWhere('step.value', 'finance');
                            @endphp


                            <div class="approval-box">

                                <div class="approval-role">
                                    Finance
                                </div>


                                @if($financeStep)

                                    @if($financeStep->decision->value === 'approved')

                                        <div class="approval-status">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approved

                                        </div>

                                    @else

                                        <div class="approval-status rejected">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Rejected

                                        </div>

                                    @endif

                                @else

                                    <div class="approval-status pending">

                                        <i class="bi bi-clock me-1"></i>

                                        Pending

                                    </div>

                                @endif

                            </div>


                            {{-- CEO --}}

                            @php
                                $ceoStep = $requestModel->steps
                                    ->firstWhere('step.value', 'ceo');
                            @endphp


                            <div class="approval-box">

                                <div class="approval-role">
                                    CEO
                                </div>


                                @if($ceoStep)

                                    @if($ceoStep->decision->value === 'approved')

                                        <div class="approval-status">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approved

                                        </div>

                                    @else

                                        <div class="approval-status rejected">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Rejected

                                        </div>

                                    @endif

                                @else

                                    <div class="approval-status pending">

                                        <i class="bi bi-clock me-1"></i>

                                        Pending

                                    </div>

                                @endif

                            </div>


                        </div>

                    </div>

                </section>


            </div>


            <!-- =====================================================
                 FOOTER
            ====================================================== -->

            <div class="footer">

                <b>Adresse</b> :
                [ADRESSE — VILLE / PROVINCE / PAYS]

            </div>


            <div class="note">

               -------

            </div>


        </div>

    </main>

    <!--end::App Main-->
    <!--begin::Footer-->
    @include('components.footer')
    <!--end::Footer-->
</div>
<!--end::App Wrapper-->
<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="../js/adminlte.js"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

<!--end::OverlayScrollbars Configure--><!--begin::Color Mode Toggle (#6010)-->
<script>
    (() => {
        'use strict';

        const STORAGE_KEY = 'lte-theme';

        const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
        const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);

        const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

        const getPreferredTheme = () => {
            const stored = getStoredTheme();
            if (stored) return stored;
            return prefersDark() ? 'dark' : 'light';
        };

        const setTheme = (theme) => {
            const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
            document.documentElement.setAttribute('data-bs-theme', resolved);
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme) => {
            // Highlight the active dropdown option
            document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
                el.classList.remove('active');
                el.setAttribute('aria-pressed', 'false');
                const check = el.querySelector('.bi-check-lg');
                if (check) check.classList.add('d-none');
            });
            const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
            if (active) {
                active.classList.add('active');
                active.setAttribute('aria-pressed', 'true');
                const check = active.querySelector('.bi-check-lg');
                if (check) check.classList.remove('d-none');
            }
            // Sync the topbar trigger icon
            document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
                icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
            });
        };

        globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const stored = getStoredTheme();
            if (!stored || stored === 'auto') setTheme(getPreferredTheme());
        });

        document.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme());
            document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value');
                    setStoredTheme(theme);
                    setTheme(theme);
                    showActiveTheme(theme);
                });
            });
        });
    })();
</script>
<!--end::Color Mode Toggle-->
<!--end::Script-->
</body>
<!--end::Body-->
</html>



