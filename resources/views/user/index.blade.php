<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carita Trips | @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
    @stack('styles')
</head>

<body>

    <div class="super_container">
        @include('user.layout.topbar')
        @yield('content')

        @include('user.layout.footer')
    </div>

    @include('components.alert')
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/lottie.js') }}"></script>



    @stack('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animationPath = '{{ asset('animations/bg.json') }}';
            const animation = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: animationPath
            });
        });
    </script>
</body>

</html>
