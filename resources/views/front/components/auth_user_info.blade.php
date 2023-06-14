

    @if (getUserRole()->id == 2)

        <section class="px-20 py-5 shadow bg-white flex">

            <article class="w-2/12">

                <div class="">
                    <img src="{{ asset(getProfile()->pic) }}" alt="" class="w-10 h-10 block rounded-full border-4 border-gray-500">
                </div>

                <div class="mt-6">

                    <span class="px-10 py-2 bg-green-300 text-green-800 rounded text-xs">{{ getUserRole()->name }}</span>

                </div>

                <div class="mt-6 text-lg font-extrabold">
                    {{ getProfile()->c_name }}
                </div>

            </article>

            <article class="w-10/12">

                <header class="pb-5 text-lg font-extrabold">
                    <i class="fas fa-chart-line"></i>
                    <span>Statistiques d'audience</span>
                </header>

                <div class="grid grid-cols-3 gap-6">

                    <div class="relative bg-orange-500 text-white rounded shadow-2xl overflow-hidden">

                        <div class="p-4">
                            <div class="text-sm font-extrabold">
                                <i class="fas fa-play"></i>
                                <span>{{ count_music_read() }}</span>
                            </div>

                            <div class="my-3 text-sm">
                                <i class="fas fa-music"></i>
                                <span>Musiques</span>
                            </div>
                        </div>

                        <div class="bg-orange-900 p-2 text-xs text-center">
                            <i class="fas fa-chart-line"></i>
                            <span>Insights</span>
                        </div>

                    </div>

                    <div class="relative bg-blue-500 text-white rounded shadow-2xl overflow-hidden">

                        <div class="p-4">
                            <div class="text-sm font-extrabold">
                                <i class="fas fa-eye"></i>
                                <span>{{ count_playlist_consult() }}</span>
                            </div>

                            <div class="my-3 text-sm">
                                <i class="fas fa-list"></i>
                                <span>Playlists</span>
                            </div>
                        </div>

                        <div class="bg-blue-900 p-2 text-xs text-center">
                            <i class="fas fa-chart-line"></i>
                            <span>Insights</span>
                        </div>

                    </div>

                    <div class="relative bg-gray-500 text-white rounded shadow-2xl overflow-hidden">

                        <div class="p-4">
                            <div class="text-sm font-extrabold">
                                <i class="fas fa-download"></i>
                                <span>{{ count_music_download() }}</span>
                            </div>

                            <div class="my-3 text-sm">
                                <i class="fas fa-music"></i>
                                <span>Musiques</span>
                            </div>
                        </div>

                        <div class="bg-gray-900 p-2 text-xs text-center">
                            <i class="fas fa-chart-line"></i>
                            <span>Insights</span>
                        </div>

                    </div>

                </div>

            </article>

        </section>

    @endif
