

    <nav class="bg-black px-[80px] py-5 flex items-center">

        <section class="w-3/12">

        </section>

        <section class="lg:w-9/12 flex lg:items-center">

            <article class="w-8/12">

                <ul class="flex items-center justify-around p-0 m-0">

                    <li class="">
                        <a href="{{ route('home') }}" class="text-gray-200 no-underline">
                            <span>Acceuil</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="" class="text-gray-200 no-underline">
                            <span>Blog</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="" class="text-gray-200 no-underline">
                            <span>À propos</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="" class="text-gray-200 no-underline">
                            <span>Nous contacter</span>
                        </a>
                    </li>

                    <li class="">
                        <a id="search-fire" href="" class="text-gray-200 no-underline">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>

                </ul>

            </article>

            <article class="w-4/12">

                <ul class="flex gap-1 justify-end">

                    @if (auth()->user())

                        <li class="relative">
                            <a id="option-trigger" href="" class="inline-block p-2 text-white border-2 border-orange-500 bg-orange-500 rounded-lg">
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <ul id="option-box" class="absolute bg-white shadow-2xl rounded top-full w-[300px] right-0 mt-2 p-3 z-50" style="display: none;">

                                <li class="my-3">
                                    <a href="{{ route('dashboard.index') }}" class="text-gray-700 no-underline text-sm">
                                        <i class="fas fa-tachometer"></i>
                                        <span>Tableau de bord</span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="" class="text-gray-700 no-underline text-sm">
                                        <i class="fas fa-cogs"></i>
                                        <span>Paramètres</span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{ route('logout') }}" class="text-gray-700 no-underline text-sm">
                                        <i class="fas fa-power-off"></i>
                                        <span>Déconnexion</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    @else

                        <li class="">
                            <a href="{{ route('register') }}" target="_blank" class="inline-block p-2 text-white border-2 border-orange-500 bg-orange-500 rounded-lg">
                                <span>S'inscrire</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ route('login') }}" target="_blank" class="inline-block p-2 text-orange-500 border-2 border-orange-500 rounded-lg">
                                <i class="fas fa-lock"></i>
                                <span>Connexion</span>
                            </a>
                        </li>

                    @endif

                </ul>

            </article>

        </section>

    </nav>
