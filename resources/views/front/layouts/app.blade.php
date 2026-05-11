<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<title>@yield('title', 'COOPROM - Promotion des Artistes')</title>

    <!-- Stylesheets -->
    <link href="{{ asset('assets/front/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/jquery.fancybox.min.css') }}" />
<link href="{{ asset('assets/front/plugins/revolution/css/settings.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/front/plugins/revolution/css/layers.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/front/plugins/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/css/custom-animations.css') }}" rel="stylesheet">

<link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/front/images/favicon.png') }}" type="image/x-icon">

    <link href="{{asset('/assets/admin/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet"/>
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="{{ asset('assets/front/js/respond.js') }}"></script><![endif]-->
@yield('extra_css')
</head>

<body>

<div class="page-wrapper color-scheme-red">

    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>

<script src="{{ asset('assets/front/js/jquery.js') }}"></script>
<script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('assets/front/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('assets/front/js/main-slider-script.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ asset('assets/front/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/front/js/appear.js') }}"></script>
<script src="{{ asset('assets/front/js/owl.js') }}"></script>
<script src="{{ asset('assets/front/js/wow.js') }}"></script>
<script src="{{ asset('assets/front/js/isotope.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
<script src="{{ asset('assets/front/js/validate.js') }}"></script>
    <script src="{{ asset('assets/front/js/script.js') }}"></script>
    <script src="{{ asset('assets/front/js/custom-animations.js') }}"></script>

    @vite(['resources/js/app.js'])
    @include('components.notification')

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
