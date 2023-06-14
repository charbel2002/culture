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

            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">#</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nom</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Musiques</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @foreach ($playlists as $key => $playlist)

                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $key + 1 }}</td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $playlist->name }}</td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                            <span class="bg-red-300 text-red-800 p-1 rounded px-5 text-xs">
                                {{ $playlist->music->count() }} Musique{{ $playlist->music->count() > 0 ? 's':'' }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                            <a href="{{ route('playlist.show',['playlist' => $playlist->id]) }}" class="inline-block mr-8 text-blue-600">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('playlist.edit',['playlist' => $playlist->id]) }}" class="inline-block mr-8 text-blue-600">
                                <i class="fas fa-pencil"></i>
                            </a>

                            <form action="{{ route('playlist.destroy',['playlist' => $playlist->id]) }}" method="post" class="inline-block action-delete">
                                @csrf
                                @method('delete')
                                <button type="submit" class="inline-block mr-8 text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                      </tr>

                    @endforeach

                  <!-- More people... -->
                </tbody>
              </table>

            @else

                <div class="my-5 bg-blue-300 text-gray-800 p-3 rounded font-extrabold">

                    <i class="fas fa-info-circle"></i> <span>Aucune playlist pour le moment</span>

                </div>

            @endif

        </article>

    </section>

@endsection
