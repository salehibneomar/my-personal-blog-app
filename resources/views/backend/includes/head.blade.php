<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ Auth::user()->settings->name }} | @yield('page_title')</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset(Auth::user()->settings->logo) }}">

<link href="{{ asset('backend/assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables/responsive.dataTables.min.css') }}">

<link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.css') }}">

<style>
    .avatar-image-custom{
        min-width: 80px;
        max-width: 80px;
        min-height: 80px;
        max-height: 80px;
    }

    .swal2-popup{
        font-size: 9pt !important;
    }

    @media all and (max-width: 500px){
        .avatar-image-custom{
            min-width: 55px;
            max-width: 55px;
            min-height: 55px;
            max-height: 55px;
        }
    }
</style>