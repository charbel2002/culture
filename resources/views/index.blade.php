@extends('layouts.app')

@section('title')
    Accueil
@endsection

@section('document')

    <section class="px-20 py-6 flex bg-black">

        <article class="lg:w-7/12">

            <div class="text-white my-6">
                <span>BIENVENUE SUR TOCEHAN</span>
            </div>

            <div class="text-orange-600 font-extrabold text-7xl">
                La plateforme de valorisation de la musique traditionnelle béninoise
            </div>

            <div class="text-gray-300 my-6">
                Streamez des podcasts et les meilleures chansons afro,
                des plus anciennes aux plus récentes tout en économisant vos données mobiles !

            </div>

            <div class="my-6">
                <a href="" class="text-white font-extrabold p-3 border-2 border-white rounded-xl inline-block">Pour les artistes</a>
            </div>

        </article>

        <article class="lg:5/12 flex items-center justify-center">

            <img src="{{ asset('images/hero.png') }}" alt="" class="block">

        </article>

    </section>

    <section class="px-20 py-6">

        <article class="owl-carousel owl-theme owl-loaded">

            <img src="{{ asset('images/slider_img.png') }}" alt="" class="">

            <img src="{{ asset('images/slider_img.png') }}" alt="" class="">

            <img src="{{ asset('images/slider_img.png') }}" alt="" class="">

            <img src="{{ asset('images/slider_img.png') }}" alt="" class="">

        </article>

    </section>

    <section class="px-20 py-6">

        <article class="grid grid-cols-2 relative">

            <div class="">
                <img src="{{ asset('images/castagnette.png') }}" alt="" class="w-10/12 rounded">
            </div>

            <div class="pt-12 flex flex-wrap items-center">

                <div class="">
                    <header class="font-extrabold text-3xl">
                        Suivre des ateliers, interviews et rencontre
                        avec les artistes traditionnels béninois.
                    </header>

                    <p class="py-7">
                        Lire l’hisoitre des rythmes, écouter,
                        télécharger et voir les artistes promoteurs de ces rythmes à souhait.
                        Parcourez les playlists par genre ou générées selon vos goûts.
                    </p>
                </div>

            </div>

            <div class="border-4 border-black w-5/12 rounded-2xl absolute left-1/4 -bottom-12"></div>

        </article>

        <article class="grid grid-cols-2 my-20 relative">

            <div class="pt-12 flex flex-wrap items-center">

                <div class="">
                    <header class="font-extrabold text-3xl">
                        Prendre connaissance des différents rythmes béninois
                    </header>

                    <p class="py-7">
                        Lire l’hisoitre des rythmes, écouter,
                        télécharger et voir les artistes promoteurs de ces rythmes.
                        Parcourez des playlists : créez, et modifiez vos playlists
                        à souhait. Parcourez les playlists par genre ou générées selon vos goûts.
                    </p>
                </div>

            </div>

            <div class="">
                <img src="{{ asset('images/drum.png') }}" alt="" class="w-10/12 rounded">
            </div>

            <div class="border-4 border-black w-5/12 rounded-2xl absolute left-1/4 -bottom-12"></div>

        </article>

        <article class="grid grid-cols-2">

            <div class="">
                <img src="{{ asset('images/hero.png') }}" alt="" class="w-10/12 rounded">
            </div>

            <div class="pt-12 flex flex-wrap items-center">

                <div class="">
                    <header class="font-extrabold text-3xl">
                        Ecouter les playlists des artistes traditionnels béninois.
                    </header>

                    <p class="py-7">
                        Lire l’hisoitre des rythmes, écouter,
                        télécharger et voir les artistes promoteurs de ces rythmes.
                        Parcourez des playlists : créez, et modifiez vos playlists
                        à souhait. Parcourez les playlists par genre ou générées selon vos goûts.
                    </p>
                </div>

            </div>

        </article>

        <article class="text-center">

            <a href="#" class="inline-block text-white font-extrabold text-xl bg-orange-600 rounded-3xl p-4">
                <span>Commencer</span>
                <i class="fas fa-angle-double-right"></i>
            </a>

        </article>

    </section>

    <section class="px-20 py-6 bg-orange-600">

        <article class="">

            <header class="text-3xl font-extrabold text-gray-200">
                <span>Abonnez vous à notre newletter !!!</span>
            </header>

            <div class="">

                <form action="" method="post">

                    @csrf

                    <div class="my-4">
                        <input type="email" name="" placeholder="Votre email" class="rounded p-3 focus:outline-none text-gray-700 block w-7/12" id="">
                    </div>

                    <div class="my-4">
                        <button class="bg-white text-orange-600 p-2 rounded font-extrabold">
                            <i class="fas fa-envelope"></i>
                            <span>Je m'abonne</span>
                        </button>
                    </div>

                </form>

            </div>

        </article>

    </section>

@endsection


@push('extra-script')

    <script type="module">

        $('.owl-carousel').owlCarousel({
            items:3,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    loop:true
                },
                600:{
                    items:2,
                    nav:true,
                    loop:true
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:true
                }
            }
        })

    </script>

@endpush
