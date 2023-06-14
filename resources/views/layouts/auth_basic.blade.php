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
<body class="bg-gray-200">

    @include('front.components.nav')

    @yield('document')

    @include('front.components.footer')

    @include('front.components.search')

    @include('front.components.confirm')

    <script src="{{ asset('owl/dist/owl.carousel.js') }}"></script>

    <script src="{{ asset('owl/dist/owl.carousel.min.js') }}"></script>

    <script>

        $(document).ready(function(){

            if(document.body.contains(document.getElementById('search-fire')))
            {

                $('#search-fire').click(e => {

                    e.preventDefault()

                    $('#search-box').toggle(100);

                })

                document.getElementById('search-box').addEventListener('click',e =>  {

                    if(e.target.matches('#search-box'))
                    {

                        $('#search-box').toggle(100);

                    }

                })

            }

            document.getElementById('option-trigger').addEventListener('click',e => {

                e.preventDefault()

                $('#option-box').toggle(100)

            })

            document.querySelectorAll('.action-delete').forEach(element => {

            element.addEventListener('submit', e => {

                e.preventDefault()

                $('#confirm-box').show(200)

                $('#cancel-operation').click(() => {
                    $('#confirm-box').hide(200)
                })

                $('#approve-operation').click(() => e.target.submit())

            })

            });

            document.getElementById('confirm-box').addEventListener('click', e => {

                if(e.target.matches('#confirm-box')) {
                    $('#confirm-box').hide(200)
                }

            })

        })

    </script>

    <script src="{{ asset('js/iziToast.js') }}"></script>

    @stack('extra-script')

    @include('vendor.lara-izitoast.toast')

</body>
</html>
