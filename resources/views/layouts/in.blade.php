<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/jquery.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.theme.default.min.css') }}">

    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

</head>
<body>

    @yield('document')

    <script src="{{ asset('owl/dist/owl.carousel.js') }}"></script>

    <script src="{{ asset('owl/dist/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('js/iziToast.js') }}"></script>

    @include('vendor.lara-izitoast.toast')

    @stack('extra-script')

</body>
</html>
