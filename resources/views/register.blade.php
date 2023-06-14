@extends('layouts.in')

@section('title')
    Inscription
@endsection

@section('document')

    <section class="grid grid-cols-2">

        <article class="h-screen flex items-center flex-column">

            <div class="text-white py-6 px-5 w-9/12">

                <form action="{{ route('user.store') }}" method="post" class="" id="register-form">

                    @csrf

                    <header class="text-orange-600 font-extrabold text-4xl">
                        Créer un compte
                    </header>

                    <p class="text-gray-600 my-6 text-sm">
                        Exploitez notre plateforme et faites valoire la musique traditionelle béninoise
                    </p>

                    <div class="my-5">

                        <label for="email" class="block font-extrabold my-2 text-black">Votre adresse mail</label>

                        <input id="email" type="text" name="email" autocomplete="off" placeholder="Votre adresse mail" class="p-3 border border-gray-400 text-gray-800 rounded block w-full focus:outline-none">

                    </div>

                    <div class="my-5">

                        <label for="password" class="block font-extrabold my-2 text-black">Choisissez un mot de passe</label>

                        <div class="flex">
                            <input id="user-password" type="password" name="password" autocomplete="off" placeholder="Mot de passe" class="p-3 border border-gray-400 text-gray-800 rounded-l block focus:outline-none w-10/12">
                            <button id="toggle-show-psw" type="button" class="w-2/12 bg-gray-400 rounded-r"><i class="fas fa-eye" id="toggle-show-psw-icon"></i></button>
                        </div>

                    </div>

                    <div class="my-5">

                        <label for="password" class="block font-extrabold my-2 text-black">Confirmez le mot de passe</label>

                        <input id="confirm-password" type="password" autocomplete="off" placeholder="Confirmez le mot de passe" class="p-3 border border-gray-400 text-gray-800 rounded block focus:outline-none w-full">

                    </div>

                    <div class="my-5">

                        <button type="submit" class="bg-orange-600 text-white font-extrabold text-sm focus:outline-none rounded p-3"> <span>S'inscrire</span> <i class="fas fa-arrow-right"></i> </button>

                    </div>

                    <div class="mt-5">

                        <span class="inline-block mr-3 text-gray-600">Vous avez un compte ?</span>
                        <a href="{{ route('login') }}" class="no-underline text-orange-600">Connectez vous</a>

                    </div>

                </form>

            </div>

        </article>

        <article class="flex items-center justify-center">

            <img src="{{ asset('images/register.png') }}" alt="" class="block w-full h-full">

        </article>

    </section>

@endsection


@push('extra-script')

    <script type="module">

        document.getElementById('toggle-show-psw').addEventListener('click',e => {

            if(document.querySelector('#toggle-show-psw-icon').classList.contains('fa-eye'))
            {

                document.querySelector('#toggle-show-psw-icon').classList.remove('fa-eye')

                document.querySelector('#toggle-show-psw-icon').classList.add('fa-eye-slash')

                document.getElementById('user-password').type = 'text'

            }
            else{

                document.querySelector('#toggle-show-psw-icon').classList.remove('fa-eye-slash')

                document.querySelector('#toggle-show-psw-icon').classList.add('fa-eye')

                document.getElementById('user-password').type = 'password'

            }

        })

        document.getElementById('register-form').addEventListener('submit',e => {

            e.preventDefault()

            if(document.getElementById('user-password').value != document.getElementById('confirm-password').value)
            {

                iziToast.error({
                    title: 'Erreur',
                    message: 'Mots de passe non conformes',
                });

            }

            e.target.submit()

        })

    </script>

@endpush
