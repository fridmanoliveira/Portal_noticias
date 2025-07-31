<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notícias - Prefeitura de Cristino Castro</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Opcional: Fallback CSS aqui, se necessário --}}
    @endif
</head>
<body class="bg-gray-100">
    <div class="bg-[#004446] text-white text-xs">
        <div class="flex items-center justify-between px-4 py-1 mx-auto sm:container">
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:underline">MAPA DO SITE</a>
                <a href="#" class="hover:underline">WEBMAIL</a>
                <button class="text-sm font-bold">A+</button>
                <button class="text-sm">A-</button>
                <button title="Modo noturno" class="w-4 h-4 border border-white rounded-full"></button>
            </div>
            <div class="flex items-center space-x-2">
                <span class="italic">Acompanhe a gente!</span>
                <a href="#" class="flex items-center justify-center w-6 h-6 bg-gray-100 rounded-sm text-[#004446]">
                    <i class="text-sm fab fa-instagram"></i>
                </a>
                <a href="#" class="flex items-center justify-center w-6 h-6 bg-gray-100 rounded-sm text-[#004446]">
                    <i class="text-sm fab fa-facebook"></i>
                </a>
                <a href="#" class="flex items-center justify-center w-6 h-6 bg-gray-100 rounded-sm text-[#004446]">
                    <i class="text-sm fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>

    <header class="py-4 bg-white shadow-md">
        <div class="flex flex-col items-center justify-between px-4 mx-auto sm:container md:flex-row">
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <img src="{{ asset('storage/logo-header.png') }}" alt="Prefeitura de Cristino Castro" class="w-auto">
            </div>
            <nav class="flex flex-wrap justify-center gap-4 font-bold text-[#004348] md:gap-20 text-sm md:text-base">
                <a href="{{ route('site.home') }}" class="transition-colors duration-300 hover:text-teal-600">INÍCIO</a>
                <a href="#" class="transition-colors duration-300 hover:text-teal-600">O MUNICÍPIO</a>
                <a href="#" class="transition-colors duration-300 hover:text-teal-600">SECRETARIAS E ÓRGÃOS</a>
                <a href="{{ route('site.noticias.index') }}" class="transition-colors duration-300 hover:text-teal-600">NOTÍCIAS</a>
                <a href="#" class="transition-colors duration-300 hover:text-teal-600">SERVIÇOS</a>
                <div class="mt-4 md:mt-0">
                    <i class="fas fa-search text-[#004348] hover:text-teal-600 cursor-pointer transition-colors duration-300 text-[30px] "></i>
                </div>
            </nav>
        </div>
    </header>

    <main class="py-8">
        <div class="container mx-auto px-4 sm:container">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Notícias</h1>

            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Opções de filtro</h2>
                <form action="{{ route('site.noticias.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="periodo_inicio" class="block text-gray-700 text-sm font-semibold mb-1">Período Início</label>
                        <input type="date" name="periodo_inicio" id="periodo_inicio" value="{{ request('periodo_inicio') }}" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="periodo_fim" class="block text-gray-700 text-sm font-semibold mb-1">Período Fim</label>
                        <input type="date" name="periodo_fim" id="periodo_fim" value="{{ request('periodo_fim') }}" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="descricao" class="block text-gray-700 text-sm font-semibold mb-1">Descrição</label>
                        <input type="text" name="descricao" id="descricao" placeholder="Buscar por título ou resumo" value="{{ request('descricao') }}" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="categoria_id" class="block text-gray-700 text-sm font-semibold mb-1">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                            <option value="">Todas as Categorias</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-full flex justify-start space-x-4 mt-4 md:mt-0">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline flex items-center">
                            <i class="fas fa-search mr-2"></i> Pesquisar
                        </button>
                        <a href="{{ route('site.noticias.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline flex items-center">
                            <i class="fas fa-eraser mr-2"></i> Limpar
                        </a>
                    </div>
                </form>
            </div>

            <div class="text-gray-600 mb-4">{{ $noticias->total() }} Notícia(s) encontrada(s).</div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($noticias as $noticia)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('site.noticias.show', $noticia->id) }}">
                    <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="{{ $noticia->titulo }}" class="w-full h-48 object-cover transition duration-300 hover:opacity-90">
                </a>
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-1 text-teal-800">
                        <a href="{{ route('site.noticias.show', $noticia->id) }}" class="hover:text-teal-600 transition">
                            {{ $noticia->titulo }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $noticia->publicado_em->format('d/m/Y H:i') }}
                        @if($noticia->categoria)
                            <span class="ml-2">|</span>
                            <i class="fas fa-tag ml-2 mr-1"></i> {{ $noticia->categoria->nome }}
                        @endif
                    </p>
                    <p class="text-gray-700 text-sm line-clamp-3">{{ $noticia->resumo }}</p>
                    <div class="mt-4 text-right">
                        <a href="{{ route('site.noticias.show', $noticia->id) }}" class="text-teal-700 hover:text-teal-800 font-medium">Leia mais »</a>
                    </div>
                </div>
            </div>
                @empty
                    <p class="text-gray-600 text-center col-span-full">Nenhuma notícia encontrada com os filtros aplicados.</p>
                @endforelse
            </div>

            {{-- Paginação --}}
            @if ($noticias->hasPages())
                <div class="mt-8 flex justify-end">
                    <ul class="inline-flex items-center space-x-1 text-sm">
                        {{-- Anterior --}}
                        @if ($noticias->onFirstPage())
                            <li class="px-3 py-1 text-gray-400 border border-gray-300 rounded">«</li>
                        @else
                            <li>
                                <a href="{{ $noticias->previousPageUrl() }}"
                                class="px-3 py-1 text-teal-800 border border-gray-300 rounded hover:bg-teal-100 transition">«</a>
                            </li>
                        @endif

                        {{-- Links de página --}}
                        @foreach ($noticias->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $noticias->currentPage())
                                <li class="px-3 py-1 bg-teal-800 text-white border border-teal-800 rounded">{{ $page }}</li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                    class="px-3 py-1 text-teal-800 border border-gray-300 rounded hover:bg-teal-100 transition">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Próxima --}}
                        @if ($noticias->hasMorePages())
                            <li>
                                <a href="{{ $noticias->nextPageUrl() }}"
                                class="px-3 py-1 text-teal-800 border border-gray-300 rounded hover:bg-teal-100 transition">»</a>
                            </li>
                        @else
                            <li class="px-3 py-1 text-gray-400 border border-gray-300 rounded">»</li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </main>

    <section class="py-8">
        <div class="px-4 mx-auto sm:container">
            @if($bannerPrincipal)
                <img src="{{ asset('storage/' . $bannerPrincipal->imagem) }}" alt="Banner Principal" class="w-full rounded shadow-md">
            @else
                {{-- Fallback para quando não houver banner --}}
                <img src="https://placehold.co/1200x300/a3e635/1c1c1c?text=Banner+de+Notícias" alt="Banner Padrão" class="w-full rounded shadow-md">
            @endif
        </div>
    </section>

    <section class="py-8">
        <div class="px-4 mx-auto sm:container">
            <div class="w-full h-70 rounded-lg shadow-md overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15873.064560064137!2d-44.597380949999995!3d-7.40939105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x789e0b1f2e1a3d3%3A0x2a9d821a719d263a!2sCristino%20Castro%2C%20PI!5e0!3m2!1spt-BR!2sbr!4v1722421389924!5m2!1spt-BR!2sbr"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

        <!-- Rodapé -->
        <footer class="bg-[#145156] text-white py-10">
            <div class="container px-4 mx-auto max-w-7xl lg:px-8">
                <!-- Topo do rodapé -->
                <div class="flex flex-col justify-between gap-8 p-6 bg-[#004348] rounded-lg md:flex-row md:items-center">
                    <!-- Endereço -->
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start gap-2">
                            <span class="w-2 h-2 mt-1 bg-green-400 rounded-full"></span>
                            <p>
                                Av. Marcos Parente, S/N, Centro - Cristino Castro<br />
                                CEP: 64920-000
                            </p>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="w-2 h-2 mt-1 bg-green-400 rounded-full"></span>
                            <p>Segunda a Sexta, das 08:00 às 14:00</p>
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/logo.png') }}" alt="Logo Prefeitura" class="h-16 mx-auto md:mx-0">
                    </div>

                    <!-- Redes sociais -->
                    <div class="text-center md:text-right">
                        <p class="mb-2 italic">Acompanhe a gente!</p>
                        <div class="flex justify-center gap-2 md:justify-end">
                            <a href="#"><img src="https://placehold.co/24x24/ffffff/165d5d?text=IG" alt="Instagram" class="rounded-sm" /></a>
                            <a href="#"><img src="https://placehold.co/24x24/ffffff/165d5d?text=FB" alt="Facebook" class="rounded-sm" /></a>
                            <a href="#"><img src="https://placehold.co/24x24/ffffff/165d5d?text=YT" alt="YouTube" class="rounded-sm" /></a>
                        </div>
                    </div>
                </div>

                <!-- Links inferiores -->
                <div class="grid grid-cols-1 gap-8 mt-10 text-lg font-light md:grid-cols-4 place-items-center">
                    <!-- Cidadão -->
                    <div class="space-y-2 r">
                        <h3 class="italic font-semibold text-white">Cidadão</h3>
                        <ul class="space-y-1">
                            <li>Ouvidoria</li>
                            <li>Carta de Serviços</li>
                        </ul>
                    </div>

                    <!-- Empresa -->
                    <div class="space-y-2 md:border-x md:border-white md:px-4">
                        <h3 class="italic font-semibold text-white">Empresa</h3>
                        <ul class="space-y-1">
                            <li>Alvará</li>
                            <li>Central de Licitações</li>
                            <li>Emissão de Certidões</li>
                        </ul>
                    </div>

                    <!-- Servidor -->
                    <div class="space-y-2 ">
                        <h3 class="italic font-semibold text-white">Servidor</h3>
                        <ul class="space-y-1">
                            <li>Contracheque Online</li>
                            <li>Portal do Servidor</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
</body>
</html>
