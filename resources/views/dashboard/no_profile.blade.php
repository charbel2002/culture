@extends('layouts.app')

@section('title')
    Configurez votre profile
@endsection

@section('document')

    <section class="px-20 py-6 flex">

        <form action="{{ route('profile.set') }}" method="post" class="w-full" enctype="multipart/form-data">

            @csrf

            <header class="text-5xl font-extrabold mb-10">Configurez votre profile</header>

            <div class="my-3">

                <label for="" class="block my-3 text-sm font-extrabold">Nom complet <span class="text-red-700">*</span></label>

                <input type="text" autocomplete="off" name="c_name" placeholder="Nom complet" class="w-8/12 p-2 text-sm border border-gray-400 rounded focus:outline-none">

            </div>

            <div class="my-3">

                <label for="" class="block my-3 text-sm font-extrabold">Profile <span class="text-red-700">*</span></label>

                <select name="role_id" id="select-box" class="w-8/12 p-2 text-sm border border-gray-400 rounded focus:outline-none">

                    <option value="">--- Choisissez votre profile</option>

                    @foreach ($roles as $role)

                        <option value="{{ $role->id }}">{{ $role->name }}</option>

                    @endforeach

                </select>

            </div>

            <div class="my-3">

                <label for="" class="block my-3 text-sm font-extrabold">Photo de profile <span class="text-red-700">*</span></label>

                <input type="file" autocomplete="off" name="pic" class="w-8/12 p-2 border border-gray-400 rounded focus:outline-none">

            </div>

            <div id="bio-box" class="my-3" style="display: none;">

                <label for="" class="block my-3 text-sm font-extrabold">Biographie <span class="text-red-700">*</span></label>

                <textarea name="bio" id="" placeholder="Biographie" class="w-8/12 p-2 text-sm border border-gray-400 rounded focus:outline-none"></textarea>

            </div>

            <div class="my-3">

                <button type="submit" class="bg-orange-600 text-white font-bold p-3 rounded">Valider</button>

            </div>

        </form>

    </section>

@endsection


@push('extra-script')

    <script type="module">

        document.getElementById('select-box').addEventListener('change',e => {

            if(e.target.value == '2')
            {
                $('#bio-box').toggle(100)
            }
            else if(e.target.value == '3')
            {
                $('#bio-box').toggle(100)
            }

        })

    </script>

@endpush
