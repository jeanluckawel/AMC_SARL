<!doctype html>
<html lang="en">

<!--begin::Head-->
@include('components.head')

@stack('styles')


<!--end::Head-->


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

{{-- Flash messages --}}
<x-alert />

<!--begin::App Wrapper-->
<div class="app-wrapper">

    <!--begin::Header-->
    @include('components.navbar')
    <!--end::Header-->


    <!--begin::Sidebar-->
    @include('components.sidebar')
    <!--end::Sidebar-->


    <!--begin::App Main-->
    <main class="app-main">

        <!--begin::App Content Header-->
        @yield('page-header')
        <!--end::App Content Header-->


        <!--begin::App Content-->
        <div class="app-content">

            <!--begin::Container-->
            @yield('content')
            <!--end::Container-->

        </div>
        <!--end::App Content-->

    </main>
    <!--end::App Main-->


    <!--begin::Footer-->
    @include('components.footer')
    <!--end::Footer-->

</div>
<!--end::App Wrapper-->


@stack('scripts')

</body>
<!--end::Body-->

</html>
