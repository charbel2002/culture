@extends('layouts.auth')


@section('title')
    Musiques
@endsection

@section('document')

    <section class="p-5">

        <article class=" bg-white rounded mb-6 p-4 shadow-sm text-lg font-extrabold flex items-center">

            <div class="w-4/12">
                <i class="fas fa-music"></i> <span>Musiques</span>
            </div>

        </article>

        <article class="bg-white rounded shadow-sm mt-8 p-4">

            @if (count($musics) > 0)

                <div class="grid grid-cols-3 gap-5">

                    @foreach ($musics as $key => $music)

                        <div class="rounded shadow-lg bg-gray-800 text-white">

                            <div class="text-5xl text-center py-5">
                                <audio src="{{ asset($music->media) }}" controls autoplay loop preload="auto" class="block w-11/12 mx-auto"></audio>
                            </div>

                            <div class="text-center py-5">
                                <i class="fas fa-record-vinyl"></i>
                                <span class="text-sm italic">{{ $music->playlist->name }}</span>
                            </div>

                            <div class="text-center py-5">
                                <span class="text-sm italic">{{ $music->title }}</span>
                            </div>

                            <div class="flex items-center justify-around py-5">

                                <a href="{{ route('music.download',['music_id' => $music->id]) }}" class="inline-block text-white">
                                    <i class="fas fa-download"></i>
                                </a>

                                <a href="{{ route('music.edit',['music' => $music->id]) }}" class="inline-block text-blue-600">
                                    <i class="fas fa-pencil"></i>
                                </a>

                                <form action="{{ route('music.destroy',['music' => $music->id]) }}" method="post" class="inline-block action-delete m-0">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="inline-block text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="my-5 bg-blue-300 text-gray-800 p-3 rounded font-extrabold">

                    <i class="fas fa-info-circle"></i> <span>Acune musique</span>

                </div>

            @endif

        </article>

    </section>

@endsection
