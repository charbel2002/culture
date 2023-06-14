@extends('layouts.auth')


@section('title')
    Ajouter un atelier
@endsection

@section('document')

    <section class="p-5">

        <article class=" bg-white rounded mb-6 p-4 shadow-sm text-lg font-extrabold flex items-center">

            <div class="w-4/12">
                <i class="fas fa-microphone-alt"></i> <span>Ajouter un atelier</span>
            </div>

            <div class="w-8/12 text-right">
                <a href="{{ route('atelier.index') }}" class="p-2 bg-blue-600 text-white rounded text-sm no-underline"> <i class="fas fa-arrow-left"></i> Retour </a>
            </div>

        </article>

        <article class="bg-white rounded shadow-sm mt-8 p-4">

            <form action="{{ route('atelier.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="my-3">

                    <label for="" class="block my-3 text-lg font-extrabold">Titre de l'atelier <span class="text-red-700">*</span></label>

                    <input type="text" autocomplete="off" name="name" placeholder="Titre de l'atelier" class="w-8/12 p-2 border border-gray-400 rounded focus:outline-none">

                </div>

                <div class="my-3">

                    <label for="" class="block my-3 text-lg font-extrabold">Description <span class="text-red-700">*</span></label>

                    <textarea name="description" id="" placeholder="Description de l'atelier" class="w-8/12 p-2 border border-gray-400 rounded focus:outline-none"></textarea>

                </div>

                <div class="my-3">

                    <label for="" class="block my-3 text-lg font-extrabold">Fichier <span class="text-red-700">*</span></label>

                    <input type="file" name="media" class="w-8/12 p-2 border border-gray-400 rounded focus:outline-none">

                </div>

                <div class="">
                    <button type="submit" class="p-2 bg-blue-600 text-white rounded text-sm">Ajouter</button>
                </div>

            </form>

        </article>

    </section>

@endsection
