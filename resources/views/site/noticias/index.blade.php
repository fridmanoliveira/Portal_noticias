<x-site-layout title="Notícias">
    <section class="px-4 py-10 mx-auto sm:container">
        <h1 class="mb-8 font-bold text-center text-gray-800">Notícias</h1>

        <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-bold text-gray-800">Opções de filtro</h2>
            <form action="{{ route('site.noticias.index') }}" method="GET"
                class="grid items-end grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <label for="periodo_inicio" class="block mb-1 font-semibold text-gray-700">Período
                        Início</label>
                    <input type="date" name="periodo_inicio" slug="periodo_inicio"
                        value="{{ request('periodo_inicio') }}"
                        class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>
                <div>
                    <label for="periodo_fim" class="block mb-1 font-semibold text-gray-700">Período Fim</label>
                    <input type="date" name="periodo_fim" slug="periodo_fim" value="{{ request('periodo_fim') }}"
                        class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 ">
                </div>

                <div>
                    <label for="descricao" class="block mb-1 font-semibold text-gray-700">Descrição</label>
                    <input type="text" name="descricao" slug="descricao" placeholder="Buscar por título ou resumo"
                        value="{{ request('descricao') }}"
                        class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 ">
                </div>

                <div>
                    <label for="categoria_id" class="block mb-1 font-semibold text-gray-700">Categoria</label>
                    <select name="categoria_id" slug="categoria_id"
                        class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 ">
                        <option value="">Todas as Categorias</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->slug }}" @selected(request('categoria_id') == $categoria->slug)>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-start mt-4 space-x-4 col-span-full md:mt-0">
                    <button type="submit"
                        class="flex items-center px-4 py-2 font-bold text-white bg-teal-600 rounded-md hover:bg-teal-700 focus:outline-none focus:shadow-outline">
                        <i class="mr-2 fas fa-search"></i> Pesquisar
                    </button>
                    <a href="{{ route('site.noticias.index') }}"
                        class="flex items-center px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded-md hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                        <i class="mr-2 fas fa-eraser"></i> Limpar
                    </a>
                </div>
            </form>
        </div>

        <div class="mb-4 text-gray-600">{{ $noticias->total() }} Notícia(s) encontrada(s).</div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($noticias as $noticia)
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white shadow-md rounded-xl hover:shadow-lg">
                    <a href="{{ route('site.noticias.show', $noticia->slug) }}">
                        <img src="{{ url($noticia->imagem) }}" alt="{{ $noticia->titulo }}"
                            class="object-cover w-full h-48 transition duration-300 hover:opacity-90">
                    </a>
                    <div class="p-5">
                        <h3 class="mb-1 font-semibold text-teal-800">
                            <a href="{{ route('site.noticias.show', $noticia->slug) }}"
                                class="transition hover:text-teal-600">
                                {{ $noticia->titulo }}
                            </a>
                        </h3>
                        <p class="mb-2 text-gray-500">
                            <i class="mr-1 far fa-calendar-alt"></i> {{ $noticia->publicado_em->format('d/m/Y H:i') }}
                            @if ($noticia->categoria)
                                <span class="ml-2">|</span>
                                <i class="ml-2 mr-1 fas fa-tag"></i> {{ $noticia->categoria->nome }}
                            @endif
                        </p>
                        <p class="text-gray-700 line-clamp-3">{{ $noticia->resumo }}</p>
                        <div class="mt-4 text-right">
                            <a href="{{ route('site.noticias.show', $noticia->slug) }}"
                                class="font-medium text-teal-700 hover:text-teal-800">Leia mais »</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-full">Nenhuma notícia encontrada com os filtros aplicados.
                </p>
            @endforelse
        </div>

        {{-- Paginação --}}
        @if ($noticias->hasPages())
            <div class="flex justify-end mt-8">
                <ul class="inline-flex items-center space-x-1 ">
                    {{-- Anterior --}}
                    @if ($noticias->onFirstPage())
                        <li class="px-3 py-1 text-gray-400 border border-gray-300 rounded">«</li>
                    @else
                        <li>
                            <a href="{{ $noticias->previousPageUrl() }}"
                                class="px-3 py-1 text-teal-800 transition border border-gray-300 rounded hover:bg-teal-100">«</a>
                        </li>
                    @endif

                    {{-- Links de página --}}
                    @foreach ($noticias->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $noticias->currentPage())
                            <li class="px-3 py-1 text-white bg-teal-800 border border-teal-800 rounded">
                                {{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-3 py-1 text-teal-800 transition border border-gray-300 rounded hover:bg-teal-100">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Próxima --}}
                    @if ($noticias->hasMorePages())
                        <li>
                            <a href="{{ $noticias->nextPageUrl() }}"
                                class="px-3 py-1 text-teal-800 transition border border-gray-300 rounded hover:bg-teal-100">»</a>
                        </li>
                    @else
                        <li class="px-3 py-1 text-gray-400 border border-gray-300 rounded">»</li>
                    @endif
                </ul>
            </div>
        @endif
    </section>

    <section class="py-8">
        <div class="px-4 mx-auto sm:container">
            @if ($bannerPrincipal)
                <img src="{{ url($bannerPrincipal->imagem) }}" alt="Banner Principal"
                    class="w-full rounded shadow-md">
            @else
                {{-- Fallback para quando não houver banner --}}
                <img src="https://placehold.co/1200x300/a3e635/1c1c1c?text=Banner+de+Notícias" alt="Banner Padrão"
                    class="w-full rounded shadow-md">
            @endif
        </div>
    </section>

    <section class="">
        <div class="w-full overflow-hidden rounded-lg shadow-md h-80">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.093055709833!2d-44.071543!3d-7.409391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x789e0b1f2e1a3d3%3A0x2a9d821a719d263a!2sCristino%20Castro%2C%20PI!5e0!3m2!1spt-BR!2sbr!4v1722421389924!5m2!1spt-BR!2sbr"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

</x-site-layout>
