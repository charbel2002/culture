

    <section class="py-4 px-5 bg-gray-700 w-2/12 shadow-lg rounded">

        <ul class="m-0 p-0">

            <li class="my-5">
                <a href="{{ route('dashboard.index') }}" class="text-white text-sm no-underline">
                    <i class="fas fa-tachometer"></i>
                    <span class="ml-4">Tableau de bord</span>
                </a>
            </li>

            <li class="my-5">
                <a href="{{ route('playlist.index') }}" class="text-white text-sm no-underline">
                    <i class="fas fa-list"></i>
                    <span class="ml-4">Mes playlists</span>
                </a>
            </li>

            <li class="my-5">
                <a href="{{ route('music.index') }}" class="text-white text-sm no-underline">
                    <i class="fas fa-music"></i>
                    <span class="ml-4">Mes musiques</span>
                </a>
            </li>

            <li class="my-5">
                <a href="{{ route('rythm.index') }}" class="text-white text-sm no-underline">
                    <i class="fas fa-water"></i>
                    <span class="ml-4">Rythmes</span>
                </a>
            </li>

            <li class="my-5">
                <a href="{{ route('atelier.index') }}" class="text-white text-sm no-underline">
                    <i class="fas fa-microphone-alt"></i>
                    <span class="ml-4">Ateliers</span>
                </a>
            </li>

            @if (getUser()->can('create-roles'))

                <li class="my-5">
                    <a href="" class="text-white text-sm no-underline">
                        <i class="fas fa-user-tag"></i>
                        <span class="ml-4">Roles</span>
                    </a>
                </li>

            @endif

            @if (getUser()->can('create-roles'))

                <li class="my-5">
                    <a href="" class="text-white text-sm no-underline">
                        <i class="fas fa-user"></i>
                        <span class="ml-4">Utilisateurs</span>
                    </a>
                </li>

            @endif

        </ul>

    </section>
