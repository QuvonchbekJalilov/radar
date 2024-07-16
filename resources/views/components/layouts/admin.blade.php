<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Admin Panel | DORA®</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta name="googlebot" content="noindex">
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="/assets/js/config.js"></script>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <x-header></x-header>
        <!--! ================================================================ !-->
        <!--! [End] Header !-->
        <!--! ================================================================ !-->
        {{ $slot }}

        <x-footer></x-footer>
    </div>
    <!--! ================================================================ !-->
    <!--! [End] Theme Customizer !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="{{ asset('/assets/vendors/js/vendors.min.js') }}"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="{{ asset('/assets/vendors/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/js/select2-active.min.js') }}"></script>
    <!-- For employees JS-->
    <script src="{{ asset('/assets/vendors/js/quill.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/js/datepicker.min.js') }}"></script>
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="{{ asset('/assets/js/common-init.min.js') }}"></script>
    <script src="{{ asset('/assets/js/reports-leads-init.min.js') }}"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="{{ asset('/assets/js/theme-customizer-init.min.js') }}"></script>
    <!--! END: Theme Customizer !-->
</body>

</html>