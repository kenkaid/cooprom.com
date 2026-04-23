<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>@yield('title', 'Connexion - COOPROM Admin')</title>
    <link rel="icon" href="{{asset('assets/admin/images/favicon-32x32.png')}}" type="image/png"/>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/bootstrap-extended.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{asset('assets/admin/css/pace.min.css')}}" rel="stylesheet"/>

</head>

<body>

<!--start wrapper-->
<div class="wrapper">

    <!--start content-->
    <main class="authentication-content">
        @yield('content')
    </main>
    <!--end page main-->

</div>
<!--end wrapper-->


<!--plugins-->
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/pace.min.js')}}"></script>


</body>

</html>
