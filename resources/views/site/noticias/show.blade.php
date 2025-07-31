<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $noticia->titulo }} - Prefeitura de Cristino Castro</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-50">

    <!-- O header e o topo permanecem os mesmos -->
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
                <span class="italic hidden sm:block">Acompanhe a gente!</span>
                <a href="#" class="flex items-center justify-center w-6 h-6 bg-gray-100 rounded-sm text-[#004446]"><i class="text-sm fab fa-instagram"></i></a>
                <a href="#" class="flex items-center justify-center w-6 h-6 bg-gray-100 rounded-sm text-[#004446]"><i class="text-sm fab fa-facebook"></i></a>
                <a href="#" class="flex items-center justify-center w-6 h-6 bg-gray-100 rounded-sm text-[#004446]"><i class="text-sm fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <header class="py-4 bg-white shadow-md">
        <div class="flex flex-col items-center justify-between px-4 mx-auto sm:container md:flex-row">
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <img src="{{ asset('storage/logo-header.png') }}" alt="Prefeitura de Cristino Castro" class="w-auto h-16 md:h-20">
            </div>
            <nav class="flex flex-wrap items-center justify-center gap-4 font-bold text-[#004348] md:gap-8 text-sm md:text-base">
                <a href="{{ route('site.home') }}" class="transition-colors duration-300 hover:text-teal-600">INÍCIO</a>
                <a href="#" class="transition-colors duration-300 hover:text-teal-600">O MUNICÍPIO</a>
                <a href="#" class="transition-colors duration-300 hover:text-teal-600">SECRETARIAS E ÓRGÃOS</a>
                <a href="{{ route('site.noticias.index') }}" class="transition-colors duration-300 hover:text-teal-600">NOTÍCIAS</a>
                <a href="#" class="transition-colors duration-300 hover:text-teal-600">SERVIÇOS</a>
                <button class="focus:outline-none">
                    <i class="fas fa-search text-[#004348] hover:text-teal-600 cursor-pointer transition-colors duration-300 text-xl md:text-2xl"></i>
                </button>
            </nav>
        </div>
    </header>

    <main class="py-8 md:py-12">
        <div class="container mx-auto px-4">
            @if($noticia)
                <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">

                    <article class="lg:col-span-2 bg-white p-6 md:p-8 rounded-lg shadow-lg">

                        <!-- ALTERAÇÃO: Cor do título principal alterada para text-teal-800 para seguir o padrão -->
                        <h1 class="text-3xl md:text-4xl font-bold text-teal-800 mb-3 leading-tight">{{ $noticia->titulo }}</h1>

                        <div class="flex flex-wrap items-center text-sm text-gray-600 mb-6">
                            <span><i class="far fa-calendar-alt mr-1.5"></i>Publicado em {{ $noticia->publicado_em->format('d/m/Y') }}</span>
                            @if($noticia->categoria)
                                <span class="mx-2">|</span>
                                <a href="{{ route('site.noticias.index', ['categoria_id' => $noticia->categoria->id]) }}" class="inline-block bg-teal-100 text-teal-800 font-medium px-2.5 py-1 rounded-full text-xs hover:bg-teal-200 transition">
                                    <i class="fas fa-tag mr-1"></i>{{ $noticia->categoria->nome }}
                                </a>
                            @endif
                        </div>

                        @if($noticia->imagem)
                            <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="{{ $noticia->titulo }}" class="w-full h-auto object-cover rounded-lg shadow-md mb-8">
                        @endif

                        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                            {!! $noticia->conteudo !!}
                        </div>
                    </article>

                    <aside class="lg:col-span-1 mt-8 lg:mt-0">
                        <div class="sticky top-8 space-y-8">

                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Compartilhar</h3>
                                <div class="flex space-x-2">
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($noticia->titulo . ' ' . Request::url()) }}" target="_blank" class="flex-1 text-center py-2 px-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300"><i class="fab fa-whatsapp"></i></a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="flex-1 text-center py-2 px-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($noticia->titulo) }}" target="_blank" class="flex-1 text-center py-2 px-3 bg-black text-white rounded-md hover:bg-gray-800 transition duration-300"><i class="fab fa-x-twitter"></i></a>
                                </div>
                            </div>

                            @if(isset($outrasNoticias) && $outrasNoticias->count())
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <!-- ALTERAÇÃO: Cor do título da seção alterada para text-teal-700 -->
                                <h3 class="text-lg font-bold text-teal-700 mb-4 border-b pb-2">Leia Também</h3>
                                <ul class="space-y-4">
                                    @foreach($outrasNoticias as $outra)
                                        <li class="border-b border-gray-100 pb-3 last:border-b-0 last:pb-0">
                                            <!-- ALTERAÇÃO: Cor do link alterada para um cinza mais escuro para melhor contraste -->
                                            <a href="{{ route('site.noticias.show', $outra->id) }}" class="font-semibold text-gray-700 hover:text-teal-600 transition duration-300">
                                                {{ $outra->titulo }}
                                            </a>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $outra->publicado_em->format('d \d\e F, Y') }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </div>
                    </aside>
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('site.noticias.index') }}" class="inline-flex items-center px-6 py-2 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Voltar para Notícias
                    </a>
                </div>

            @else
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <p class="text-gray-700 text-lg">Notícia não encontrada.</p>
                </div>
            @endif
        </div>
    </main>
    
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
