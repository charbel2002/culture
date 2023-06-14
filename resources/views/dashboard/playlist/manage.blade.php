@extends('layouts.auth')


@section('title')
    Playlists
@endsection

@section('document')

    <section class="p-5">

        <article class=" bg-white rounded mb-6 p-4 shadow-sm text-lg font-extrabold flex items-center">

            <div class="w-4/12">
                <i class="fas fa-list"></i> <span>Playlists</span>
            </div>

            <div class="w-8/12 text-right">
                <a href="{{ route('playlist.create') }}" class="p-2 bg-blue-600 text-white rounded text-sm no-underline"> <i class="fas fa-plus"></i> Créer une playlist </a>
            </div>

        </article>

        <article class="bg-white rounded shadow-sm mt-8 p-4">

            @if (count($playlists) > 0)

                <div class="grid grid-cols-4 gap-5">

                    @foreach ($playlists as $key => $playlist)

                        <div class="rounded shadow-lg bg-gray-800 text-white">

                            <div class="text-5xl text-center py-5">
                                <i class="fas fa-record-vinyl"></i>
                            </div>

                            <div class="text-center py-5">
                                <span class="text-sm italic">{{ $playlist->name }} ({{ $playlist->music->count() }})</span>
                            </div>

                            <div class="flex items-center justify-around py-5">

                                <a href="{{ route('playlist.show',['playlist' => $playlist->id]) }}" class="inline-block text-green-600">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('playlist.edit',['playlist' => $playlist->id]) }}" class="inline-block text-blue-600">
                                    <i class="fas fa-pencil"></i>
                                </a>

                                <form action="{{ route('playlist.destroy',['playlist' => $playlist->id]) }}" method="post" class="inline-block action-delete m-0">
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

                    <i class="fas fa-info-circle"></i> <span>Aucune playlist pour le moment</span>

                </div>

            @endif

        </article>

    </section>

@endsection
