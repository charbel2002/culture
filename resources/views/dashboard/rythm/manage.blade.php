@extends('layouts.auth')


@section('title')
    Rythmes
@endsection

@section('document')

    <section class="p-5">

        <article class=" bg-white rounded mb-6 p-4 shadow-sm text-lg font-extrabold flex items-center">

            <div class="w-4/12">
                <i class="fas fa-water"></i> <span>Rythmes</span>
            </div>

            <div class="w-8/12 text-right">
                <a href="{{ route('rythm.create') }}" class="p-2 bg-blue-600 text-white rounded text-sm no-underline"> <i class="fas fa-plus"></i> Ajouter un rythme</a>
            </div>

        </article>

        <article class="bg-white rounded shadow-sm mt-8 p-4">

            @if (count($rythms) > 0)

                <div class="grid grid-cols-3 gap-5">

                    @foreach ($rythms as $key => $rythm)

                        <div class="rounded shadow-lg bg-gray-800 text-white">

                            <div class="text-5xl text-center py-5">
                                <audio src="{{ asset($rythm->media) }}" controls autoplay loop preload="auto" class="block w-11/12 mx-auto"></audio>
                            </div>

                            <div class="text-center py-5">
                                <span class="text-sm italic">{{ $rythm->title }}</span>
                            </div>

                            <div class="flex items-center justify-around py-5">

                                <a href="{{ route('rythm.download',['rythm_id' => $rythm->id]) }}" class="inline-block text-white">
                                    <i class="fas fa-download"></i>
                                </a>

                                <a href="{{ route('rythm.edit',['rythm' => $rythm->id]) }}" class="inline-block text-blue-600">
                                    <i class="fas fa-pencil"></i>
                                </a>

                                <form action="{{ route('rythm.destroy',['rythm' => $rythm->id]) }}" method="post" class="inline-block action-delete m-0">
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

                    <i class="fas fa-info-circle"></i> <span>Accun rythme</span>

                </div>

            @endif

        </article>

    </section>

@endsection
