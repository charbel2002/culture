@extends('layouts.auth')

@section('title')
    Compte - {{ auth()->user()->name }}
@endsection

@section('document')

    <section class="shadow-md p-3 rounded font-extrabold bg-white">

        <i class="fas fa-tachometer"></i>
        <span class="ml-4">Tableau de bord</span>

    </section>

    <section class="grid grid-cols-2 gap-5 my-10 bg-white p-5">

        <article class="bg-blue-700 tetx-white rounded p-4 relative">

            <a href="{{ route('playlist.index') }}" class="block absolute top-0 left-0 right-0 bottom-0"></a>

            <div class="text-white font-extrabold text-4xl">
                {{ $count_playlists }}
            </div>

            <div class="text-white font-extrabold text-lg my-5">
                <i class="fas fa-list"></i>
                <span class="ml-4">Mes playlists</span>
            </div>

        </article>

        <article class="bg-orange-700 tetx-white rounded p-4 relative">

            <a href="{{ route('music.index') }}" class="block absolute top-0 left-0 right-0 bottom-0"></a>

            <div class="text-white font-extrabold text-4xl">
                {{ $count_musics }}
            </div>

            <div class="text-white font-extrabold text-lg my-5">
                <i class="fas fa-music"></i>
                <span class="ml-4">Mes musiques</span>
            </div>

        </article>

        <article class="bg-green-700 tetx-white rounded p-4 relative">

            <a href="{{ route('rythm.index') }}" class="block absolute top-0 left-0 right-0 bottom-0"></a>

            <div class="text-white font-extrabold text-4xl">
                {{ $count_rythms }}
            </div>

            <div class="text-white font-extrabold text-lg my-5">
                <i class="fas fa-compact-disc"></i>
                <span class="ml-4">Rythmes</span>
            </div>

        </article>

        <article class="bg-gray-700 tetx-white rounded p-4 relative">

            <a href="{{ route('atelier.index') }}" class="block absolute top-0 left-0 right-0 bottom-0"></a>

            <div class="text-white font-extrabold text-4xl">
                {{ $count_ateliers }}
            </div>

            <div class="text-white font-extrabold text-lg my-5">
                <i class="fas fa-microphone-alt"></i>
                <span class="ml-4">Ateliers</span>
            </div>

        </article>

        @if (getUser()->can('create-roles'))

            <article class="bg-lime-700 tetx-white rounded p-4 relative">

                <a href="" class="block absolute top-0 left-0 right-0 bottom-0"></a>

                <div class="text-white font-extrabold text-4xl">
                    {{ $count_roles }}
                </div>

                <div class="text-white font-extrabold text-lg my-5">
                    <i class="fas fa-user-tag"></i>
                    <span class="ml-4">Rôles</span>
                </div>

            </article>

        @endif

        @if (getUser()->can('create-users'))

            <article class=" bg-cyan-700 tetx-white rounded p-4 relative">

                <a href="" class="block absolute top-0 left-0 right-0 bottom-0"></a>

                <div class="text-white font-extrabold text-4xl">
                    {{ $count_users }}
                </div>

                <div class="text-white font-extrabold text-lg my-5">
                    <i class="fas fa-user"></i>
                    <span class="ml-4">Utilisateurs</span>
                </div>

            </article>

        @endif

    </section>

    <section class="shadow-md p-3 rounded font-extrabold bg-white">

        <i class="fas fa-chart-pie"></i>
        <span class="ml-4">Statistiques</span>

    </section>

    <section class="shadow-md p-3 rounded my-10 bg-white">



    </section>

@endsection


@push('extra-script')

    <script type="module">



    </script>

@endpush
