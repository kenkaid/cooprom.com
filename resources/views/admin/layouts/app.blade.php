<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="user-id" content="{{ auth()->id() }}">
    <title>@yield('title', 'Admin Dashboard - COOPROM')</title>
    <!--plugins-->
    <link href="{{asset('/assets/admin/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/bootstrap-extended.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- loader-->
    <link href="{{asset('assets/admin/css/pace.min.css')}}" rel="stylesheet"/>


    <!--Theme Styles-->
    <link href="{{asset('assets/admin/css/dark-theme.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/light-theme.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/semi-dark.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/header-colors.css')}}" rel="stylesheet"/>
</head>

<body class="bg-theme bg-theme1">

<!--start wrapper-->
<div class="wrapper">

    @include('admin.partials.sidebar')

    @include('admin.partials.header')

    <!--start content-->
    <main class="page-content">
        @yield('content')
    </main>
    <!--end page main-->

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bi bi-arrow-up-short'></i></a>
    <!--End Back To Top Button-->

    @include('admin.partials.footer')

</div>

<!-- Bootstrap bundle JS -->
<script src="{{asset('assets/admin/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    @include('components.notification')

    @vite(['resources/js/app.js'])
<script src="{{asset('assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/admin/js/pace.min.js')}}"></script>

    <!--app-->
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script src="{{asset('assets/admin/js/index4.js')}}"></script>

@yield('extra_js')

</body>
</html>
