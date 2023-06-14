
@extends('layouts.auth_basic')

@section('title')
    Compte utilisateur
@endsection

@section('document')

    <section class="px-20 my-10">

        <article class="py-6 bg-white shadow-sm rounded flex px-10">

            <div class="w-3/12">

                <form action="" method="post">

                    @csrf

                    <div class="my-5">
                        <input type="search" name="keywords" class="block w-full focus:outline-none border border-gray-300 rounded p-2 text-sm" placeholder="Recherchez une chanson ou un artiste" id="">
                    </div>

                    <div class="my-5">
                        <button class="bg-orange-600 text-white text-sm font-bold p-2 rounded">
                            <i class="fas fa-search"></i>
                            <span>Rechercher</span>
                        </button>
                    </div>

                </form>

            </div>

            <div class="w-9/12 px-6">

                <div class="my-5">

                    <header class="font-bold text-lg">
                        <i class="fas fa-music"></i>
                        <span>Musiques récentes</span>
                    </header>

                    <div class="">

                        @forelse ($latest_musics as $music)

                            <div class="py-3 px-4 bg-orange-300 rounded text-sm font-bold my-5 grid grid-cols-3">

                                <div class="text-orange-950">
                                    <i class="fas fa-music"></i>
                                    <span>{{ $music->title }}</span>
                                </div>

                                <div class="text-orange-950">
                                    {{ formatSizeUnits(fileSize(public_path($music->media))) }}
                                </div>

                                <div class="text-orange-950 flex items-center justify-center">

                                    <ul class="flex gap-6">
                                        <li class="">
                                            <a download href="{{ asset($music->media) }}" data-id="{{ $music->id }}" class="text-orange-950 no-underline download-music-action">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </li>
                                        <li class="">

                                            <form action="{{ route('music.play') }}" method="post" class="p-0 m-0 music-play inline-block">

                                                @csrf

                                                <input type="hidden" name="music_id" value="{{ $music->id }}">
                                                <input type="hidden" name="file" value="{{ asset($music->media) }}">

                                                <button type="submit" class="text-orange-950 no-underline"><i class="fas fa-play"></i></button>

                                            </form>

                                        </li>
                                    </ul>

                                </div>

                            </div>

                        @empty

                            <div class="italic my-12 bg-blue-300 text-blue-950 p-2 rounded text-sm font-extrabold">
                                <i class="fas fa-info"></i>
                                <span>Aucune musique disponible sur la plateforme</span>
                            </div>

                        @endforelse

                    </div>

                </div>

                <div class="my-5">

                    <header class="font-bold text-lg">
                        <i class="fas fa-list"></i>
                        <span>Playlists récentes</span>
                    </header>

                    <div class="">

                        <div class="grid grid-cols-4 my-5">

                            @foreach ($latest_playlists as $playlist)

                                <div class="bg-orange-300 rounded relative">

                                    <a id="{{ $playlist->id }}" href="{{ route('playlist.explore',['playlist' => $playlist->id]) }}" class="absolute top-0 bottom-0 left-0 right-0 playlist-action"></a>

                                    <div class="text-5xl text-center pt-6 text-orange-950">
                                        <i class="fas fa-record-vinyl"></i>
                                    </div>

                                    <div class="text-center py-5 text-orange-950 text-sm font-bold">
                                        <span class="text-sm italic">{{ $playlist->name }} ({{ $playlist->music->count() }})</span>
                                    </div>

                                    <div class="text-center pb-5 text-orange-950 text-sm font-bold">
                                        (<span class="text-sm italic">{{ $playlist->artiste->profile->c_name }}</span>)
                                    </div>

                                </div>

                            @endforeach

                        </div>

                        @forelse ($latest_playlists as $playlist)

                        @empty

                            <div class="italic my-12 bg-blue-300 text-blue-950 p-2 rounded text-sm font-extrabold">
                                <i class="fas fa-info"></i>
                                <span>Aucune playlist disponible sur la plateforme</span>
                            </div>

                        @endforelse

                    </div>

                </div>

                <div class="my-5">

                    <header class="font-bold text-lg">
                        <i class="fas fa-asterisk"></i>
                        <span>Vos musiques</span>
                    </header>

                    <div class="">

                        @forelse ($latest_playlists as $playlist)

                        @empty

                            <div class="italic my-12 bg-blue-300 text-blue-950 p-2 rounded text-sm font-extrabold">
                                <i class="fas fa-info"></i>
                                <span>Aucune musiaue disponible sur la plateforme</span>
                            </div>

                        @endforelse

                    </div>

                </div>

                <div class="my-5">

                    <header class="font-bold text-lg">
                        <i class="fas fa-asterisk"></i>
                        <span>Vos playlists</span>
                    </header>

                    <div class="">

                        @forelse ($latest_playlists as $playlist)

                        @empty

                            <div class="italic my-12 bg-blue-300 text-blue-950 p-2 rounded text-sm font-extrabold">
                                <i class="fas fa-info"></i>
                                <span>Aucune playlist disponible sur la plateforme</span>
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </article>

    </section>

@endsection


@push('extra-script')

    <script type="module">

        function downloadFile(url) {
            var link = document.createElement('a');
            link.href = url;
            link.download = true;

            // Simulate a click event
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                event.initEvent('click', true, true);
                link.dispatchEvent(event);
            } else {
                link.click();
            }
        }

        const send_request = (route,form) => {

            return new Promise((resolve,reject) => {

                var request = new XMLHttpRequest()

                request.onreadystatechange = function () {

                    if(this.status == 200 && this.readyState == 4)
                    {
                        resolve(this.responseText)
                    }

                }

                request.open('POST',route)
                request.send(form)

            })

        }

        document.addEventListener('DOMContentLoaded', function() {

            var PlayForms = document.querySelectorAll('.music-play')

            PlayForms.forEach(form => {

                form.addEventListener('submit',async e => {

                    e.preventDefault()

                    var form = new FormData()

                    form.append('music_id', e.target['music_id'].value)
                    form.append('_token',"{{ csrf_token() }}")

                    var route = e.target.action

                    await send_request(route,form)
                    .then(res => JSON.parse(res))
                    .then(res => {

                        if(res.code == 200)
                        {
                            window.open(e.target['file'].value)
                            window.location.reload()
                        }
                        else{
                            iziToast.error({
                                message: res.text,
                            });
                        }

                    })

                })

            });

            var PlayLists =document.querySelectorAll('.playlist-action')

            PlayLists.forEach(playlist => {

                playlist.addEventListener('click',async e => {

                    e.preventDefault()

                    var form = new FormData()

                    form.append('playlist_id', e.target.id)
                    form.append('_token',"{{ csrf_token() }}")

                    var route = "{{ route('playlist.consult') }}"

                    await send_request(route,form)
                    .then(res => JSON.parse(res))
                    .then(res => {

                        if(res.code == 200)
                        {
                            window.location.assign(e.target.href)
                        }
                        else{
                            iziToast.error({
                                message: res.text,
                            });
                        }

                    })

                })

            });

            var MusicDownloads = document.querySelectorAll('.download-music-action')

            MusicDownloads.forEach(download_but => {

                download_but.addEventListener('click',async e => {

                    e.preventDefault()

                    var form = new FormData()

                    form.append('music_id', e.target.closest('a').getAttribute('data-id'))
                    form.append('_token',"{{ csrf_token() }}")

                    var route = "{{ route('music.download.action') }}"

                    await send_request(route,form)
                    .then(res => JSON.parse(res))
                    .then(res => {

                        if(res.code == 200)
                        {
                            downloadFile(e.target.closest('a').getAttribute('href'))
                            window.location.reload()
                        }
                        else{
                            iziToast.error({
                                message: res.text,
                            });
                        }

                    })

                })

            });

        });

    </script>

@endpush


