{{--@extends('layouts.admin')--}}

{{--@section('content')--}}

{{--    --}}

{{--@endsection--}}


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
    <link rel="preload" href="{{ asset('css/adminlte.css')}}" as="style" />
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
    <link rel="stylesheet" href="{{ asset('css/adminlte.css')}}" />
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

        {{-- =========================================================
             HEADER
        ========================================================== --}}

        <div class="app-content-header">

            <div class="container-fluid">

                <div class="row align-items-center">

                    <div class="col-md-7 col-12">

                        <div class="page-heading">

                            <div class="page-icon">
                                <i class="bi bi-clipboard-check"></i>
                            </div>

                            <div>

                                <h3 class="mb-1">
                                    Process Request
                                </h3>

                                <div class="text-muted small">
                                    Review and validate procurement details
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-md-8">

                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            Upload Request Document
                                        </h5>
                                    </div>


                                    <div class="card-body">


                                        {{-- SUCCESS MESSAGE --}}
                                        @if(session('success'))

                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>

                                        @endif


                                        {{-- ERROR MESSAGE --}}
                                        @if(session('error'))

                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>

                                        @endif


                                        {{-- VALIDATION ERRORS --}}
                                        @if($errors->any())

                                            <div class="alert alert-danger">

                                                <ul class="mb-0">

                                                    @foreach($errors->all() as $error)

                                                        <li>
                                                            {{ $error }}
                                                        </li>

                                                    @endforeach

                                                </ul>

                                            </div>

                                        @endif


                                        {{-- REQUEST INFORMATION --}}

                                        <div class="mb-4">

                                            <h6>
                                                Request Information
                                            </h6>

                                            <hr>


                                            <div class="row mb-2">

                                                <div class="col-md-4">
                                                    <strong>Reference:</strong>
                                                </div>

                                                <div class="col-md-8">
                                                    {{ $request->reference }}
                                                </div>

                                            </div>


                                            <div class="row mb-2">

                                                <div class="col-md-4">
                                                    <strong>Title:</strong>
                                                </div>

                                                <div class="col-md-8">
                                                    {{ $request->title }}
                                                </div>

                                            </div>


                                            <div class="row mb-2">

                                                <div class="col-md-4">
                                                    <strong>Amount:</strong>
                                                </div>

                                                <div class="col-md-8">

                                                    <strong>
                                                        {{ number_format($request->total_amount, 2) }}
                                                    </strong>

                                                    USD

                                                </div>

                                            </div>


                                            </div>

                                        </div>


                                        {{-- UPLOAD FORM --}}

                                        @if(!$request->budget_consumed)

                                            <form
                                                action="{{ route('requests.document.store', $request) }}"
                                                method="POST"
                                                enctype="multipart/form-data"
                                            >

                                                @csrf


                                                <div class="mb-3">

                                                    <label
                                                        for="document"
                                                        class="form-label"
                                                    >
                                                        Supporting Document
                                                    </label>


                                                    <input
                                                        type="file"
                                                        name="document"
                                                        id="document"
                                                        class="form-control @error('document') is-invalid @enderror"
                                                        accept=".pdf,.jpg,.jpeg,.png"
                                                        required
                                                    >


                                                    @error('document')

                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>

                                                    @enderror


                                                    <small class="text-muted">
                                                        PDF, JPG, JPEG or PNG.
                                                        Maximum size: 10 MB.
                                                    </small>

                                                </div>


                                                <div class="d-flex justify-content-between">

                                                    <a
                                                        href="{{ route('requests.show', $request) }}"
                                                        class="btn btn-secondary"
                                                    >
                                                        Cancel
                                                    </a>


                                                    <button
                                                        type="submit"
                                                        class="btn btn-success"
                                                    >

                                                        <i class="bi bi-cloud-arrow-up"></i>

                                                        Upload & Release Amount

                                                    </button>

                                                </div>

                                            </form>

                                        @else

                                            <div class="alert alert-success">

                                                <i class="bi bi-check-circle"></i>

                                                The document has already been uploaded
                                                and the request amount has already been released.

                                            </div>


                                            @if($request->document_path)

                                                <a
                                                    href="{{ asset('storage/' . $request->document_path) }}"
                                                    target="_blank"
                                                    class="btn btn-primary"
                                                >

                                                    <i class="bi bi-file-earmark"></i>

                                                    View Document

                                                </a>

                                            @endif

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>




        {{-- =========================================================
             CONTENT
        ========================================================== --}}



        {{-- =========================================================
             STYLE
        ========================================================== --}}




        {{-- =========================================================
             JAVASCRIPT
        ========================================================== --}}



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






