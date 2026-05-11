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
    <!--favicon-->
    <link rel="icon" href="{{asset('assets/admin/images/icons/favicon.ico')}}" type="image/x-icon">
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

<script>
    // Handle Logout with 419 error check
    function handleLogout(formId) {
        const form = document.getElementById(formId);
        if (!form) return;

        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(response => {
            if (response.status === 419) {
                // Session expired, reload to get new token and then logout will work or user will be redirected to login
                window.location.reload();
            } else {
                // Normal redirect after logout
                window.location.href = '/';
            }
        }).catch(error => {
            // On error, just try submitting the form normally
            form.submit();
        });
    }

    // Refresh CSRF token every 15 minutes to prevent 419 errors
    setInterval(function() {
        fetch('{{ route('refresh-csrf') }}')
            .then(response => response.json())
            .then(data => {
                const tokens = document.querySelectorAll('input[name="_token"]');
                tokens.forEach(token => token.value = data.token);

                const meta = document.querySelector('meta[name="csrf-token"]');
                if (meta) meta.setAttribute('content', data.token);
            })
            .catch(error => console.error('Error refreshing CSRF token:', error));
    }, 15 * 60 * 1000); // 15 minutes
</script>

</body>
</html>
