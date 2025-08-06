<x-site-layout title="Inicio">
    <!-- Banner Principal - Otimizado para mobile -->
    <section class="py-3 sm:py-4 sm:container">
            @if($bannerPrincipal)
            <img src="{{ url($bannerPrincipal->imagem) }}"
                 alt="Banner Principal"
                 class="w-full rounded shadow-sm sm:shadow-md"
                 loading="eager"
                 >
            @endif
    </section>

    <!-- Início da Seção de Notícias -->
    <section class="px-4 py-6 mx-auto sm:container">
        <!-- Título da Seção -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold text-gray-800 sm:italic sm:font-extrabold sm:text-gray-700">Últimas Notícias</h2>
            <a href="{{ route('site.noticias.index') }}" class="font-medium text-teal-600 hover:text-teal-800">
                Ver todas →
            </a>
        </div>

        <!-- Container Principal (Layout de duas colunas) -->
        <div class="flex flex-col gap-8 lg:flex-row">
            <!-- Coluna Esquerda: Carrossel de Notícias -->
            <div class="w-full lg:w-2/3"
                x-data="{
                    noticias: {{ Js::from($noticiasCarrossel) }},
                    activeIndex: 0,
                    autoplay: null,
                    init() {
                        if (this.noticias.length > 1) {
                            this.startAutoplay();
                        }
                    },
                    startAutoplay() {
                        this.autoplay = setInterval(() => {
                            this.next();
                        }, 5000); // Muda a cada 5 segundos
                    },
                    stopAutoplay() {
                        clearInterval(this.autoplay);
                    },
                    next() {
                        this.activeIndex = this.activeIndex === this.noticias.length - 1 ? 0 : this.activeIndex + 1;
                    },
                    prev() {
                        this.activeIndex = this.activeIndex === 0 ? this.noticias.length - 1 : this.activeIndex - 1;
                    },
                    goTo(index) {
                        this.activeIndex = index;
                    }
                }"
                @mouseenter="stopAutoplay"
                @mouseleave="startAutoplay">

                <div class="relative overflow-hidden rounded-lg shadow-lg h-96">
                    <!-- Slides do Carrossel -->
                    <template x-for="(noticia, index) in noticias" :key="noticia.slug">
                        <div x-show="activeIndex === index"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 flex items-end w-full h-full">
                            <!-- Imagem de Fundo -->
                            <img :src="noticia.imagem"
                                :alt="noticia.titulo"
                                class="object-cover w-full h-full">

                            <!-- Overlay com Gradiente e Título -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6 text-white">
                                <a :href="'/noticias/' + noticia.slug" class="block">
                                    <h3 class="font-bold leading-tight transition-colors hover:text-teal-300"
                                        x-text="noticia.titulo"></h3>
                                </a>
                            </div>
                        </div>
                    </template>

                    <!-- Controles de Navegação (Setas) -->
                    <template x-if="noticias.length > 1">
                        <div class="absolute inset-y-0 left-0 flex items-center">
                            <button @click="prev()"
                                    class="p-2 -ml-2 text-white transition-transform duration-300 transform bg-black bg-opacity-25 rounded-full hover:bg-opacity-50 hover:scale-110 focus:outline-none">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </template>
                    <template x-if="noticias.length > 1">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button @click="next()"
                                    class="p-2 -mr-2 text-white transition-transform duration-300 transform bg-black bg-opacity-25 rounded-full hover:bg-opacity-50 hover:scale-110 focus:outline-none">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Paginação (Bolinhas) -->
                    <template x-if="noticias.length > 1">
                        <div class="absolute flex space-x-2 -translate-x-1/2 bottom-4 left-1/2">
                            <template x-for="(noticia, index) in noticias" :key="'dot-' + noticia.slug">
                                <button @click="goTo(index)"
                                        class="w-3 h-3 transition-colors rounded-full"
                                        :class="{'bg-white': activeIndex === index, 'bg-white/50 hover:bg-white/75': activeIndex !== index}"></button>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Coluna Direita: Grid de Notícias -->
            <div class="w-full lg:w-1/3">
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($noticiasGrid as $noticia)
                        <div class="relative overflow-hidden rounded-lg shadow-lg group">
                            <a href="{{ route('site.noticias.show', $noticia->slug) }}" class="block w-full h-full">
                                <!-- Imagem -->
                                <img src="{{ url($noticia->imagem) }}"
                                    alt="{{ $noticia->titulo }}"
                                    class="object-cover w-full transition-transform duration-300 h-46 group-hover:scale-110">
                                <!-- Overlay com Gradiente e Título -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-3 text-white">
                                    <h4 class="font-semibold leading-tight line-clamp-2">{{ $noticia->titulo }}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
    <!-- Fim da Seção de Notícias -->

    <!-- Links Rápidos - Responsivo -->
    <section class="py-6 sm:py-10">
        <div class="grid gap-3 px-2 mx-auto sm:container md:grid-cols-3">
            @foreach([
                ['icon' => url('icons/searching.png'), 'text' => 'PORTAL DA<br>TRANSPARÊNCIA'],
                ['icon' => url('icons/support.png'), 'text' => 'OUVIDORIA DE<br>CRISTINO CASTRO'],
                ['icon' => url('icons/radar.png'), 'text' => 'RADAR NACIONAL DA<br>TRANSPARÊNCIA PÚBLICA']
            ] as $link)
            <a href="#" class="flex items-center gap-3 px-4 py-4 text-white rounded-lg shadow-sm transition-all hover:shadow-md bg-gradient-to-r from-[#008f9c] to-[#005d6d] h-24 sm:h-32 sm:gap-4 sm:px-6 sm:py-5 sm:rounded-lg sm:shadow-md">
                <img src="{{ $link['icon'] }}" alt="" class="w-8 h-8 sm:w-12 sm:h-12">
                <p class="font-bold leading-tight sm:italic">{!! $link['text'] !!}</p>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Carrossel - Responsivo -->
    @if ($bannerCarrossel->count())
    <section class="px-2 py-6 mx-auto sm:container">
        <div x-data="bannerCarrossel()" x-init="init" class="relative w-full overflow-hidden rounded-lg shadow-sm sm:shadow-lg h-[180px] sm:h-[250px]">
            <!-- Slides -->
            <template x-for="(banner, index) in banners" :key="index">
                <div x-show="activeSlide === index" x-transition class="absolute inset-0">
                    <template x-if="banner.link">
                        <a :href="banner.link" target="_blank">
                            <img :src="banner.imagem" :alt="banner.titulo" class="object-cover w-full h-full">
                        </a>
                    </template>
                    <template x-if="!banner.link">
                        <img :src="banner.imagem" :alt="banner.titulo" class="object-cover w-full h-full">
                    </template>
                </div>
            </template>

            <!-- Controles -->
            <div class="absolute inset-0 flex items-center justify-between px-2 sm:px-4">
                <button @click="prev" class="p-1 text-white transition rounded-full bg-black/50 hover:bg-black/70 sm:p-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button @click="next" class="p-1 text-white transition rounded-full bg-black/50 hover:bg-black/70 sm:p-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Indicadores -->
            <div class="absolute flex gap-1 transform -translate-x-1/2 bottom-2 left-1/2 sm:bottom-4 sm:gap-2">
                <template x-for="(banner, index) in banners" :key="index">
                    <button @click="activeSlide = index"
                            class="w-2 h-2 transition-colors rounded-full sm:w-3 sm:h-3"
                            :class="{'bg-white': activeSlide === index, 'bg-white/50': activeSlide !== index}">
                    </button>
                </template>
            </div>
        </div>
    </section>
    @endif

    <!-- Acesso Rápido - Responsivo -->
    <section class="px-2 py-6 mx-auto sm:container max-w-7xl sm:py-12">
        <h2 class="mb-4 font-bold text-gray-800 sm:mb-6 sm:italic sm:font-extrabold sm:text-gray-700">ACESSO RÁPIDO</h2>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-1 sm:gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($acessosRapidos as $acesso)
            <a href="{{ $acesso->link }}" class="flex flex-col items-start p-4 text-white transition-transform duration-300 rounded-lg shadow-sm bg-gradient-to-r from-[#008f9c] to-[#005d6d] hover:scale-[1.03] sm:p-6 sm:hover:scale-105">
                <img src="{{ url($acesso->icone) }}"
                     alt="{{ $acesso->titulo }}"
                     class="w-8 h-8 mb-2 sm:w-10 sm:h-10 sm:mb-4">
                <p class="font-bold leading-tight ">{{ $acesso->titulo }}</p>
                <p class="hidden mt-2 opacity-80 sm:block">Clique para acessar</p>
            </a>
            @endforeach
        </div>
    </section>

    <!-- História - Responsivo -->
    <section class="relative bg-center bg-cover" style="background-image: url('{{ url('fundo.png') }}')">
        <div class="bg-teal-900 bg-opacity-70">
            <div class="grid items-center grid-cols-1 gap-6 px-4 py-8 mx-auto sm:container md:grid-cols-2 sm:gap-10 sm:py-16">
                <!-- Texto -->
                <div class="text-white" x-data="{ open: false }">
                    <h2 class="font-bold leading-snug sm:font-extrabold">
                        {{ $video->titulo ?? 'A História de Cristino Castro' }}
                    </h2>
                    <div class="mt-3 leading-relaxed sm:text-base sm:mb-4 sm:prose sm:prose-invert sm:max-w-none">
                        {!! \Illuminate\Support\Str::limit(strip_tags($video->descricao), 200) !!}
                    </div>
                    <button @click="open = true" class="mt-2 font-semibold text-green-300 underline transition hover:text-green-200 sm:mt-0">
                        Continue lendo...
                    </button>

                    <!-- Modal -->
                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 sm:p-0" x-transition>
                        <div @click.away="open = false" class="relative w-full max-w-4xl p-6 mx-4 overflow-y-auto bg-white rounded-lg shadow-xl sm:p-8 sm:mx-0" style="max-height: 90vh;">
                            <button @click="open = false" class="absolute text-2xl text-gray-500 transition hover:text-gray-700 top-4 right-4">&times;</button>
                            <h3 class="mb-4 font-bold sm:text-2xl">{{ $video->titulo ?? 'A História de Cristino Castro' }}</h3>
                            <div class="prose max-w-none sm:prose-lg">
                                {!! $video->descricao !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vídeo -->
                <div class="aspect-video">
                    @if(!empty($video->link_youtube))
                        <iframe class="w-full h-full rounded-lg"
                                src="{{ $video->link_youtube }}"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-800 rounded-lg">
                            <p class="text-gray-400">Vídeo não disponível</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Botão -->
            <div class="py-4 text-center sm:py-6">
                <a href="#" class="inline-block px-4 py-2 text-sm font-semibold text-white transition bg-[#1DC98A] rounded-md shadow-md hover:bg-opacity-70 sm:px-6 sm:py-3 sm:bg-[#1DC98A]/50 sm:hover:bg-[#1DC98A]">
                    VEJA TAMBÉM O INVENTÁRIO DA OFERTA TURÍSTICA
                </a>
            </div>
        </div>
    </section>

    <script>
        function bannerCarrossel() {
            return {
                activeSlide: 0,
                banners: @json($bannerCarrossel),
                interval: null,
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.banners.length;
                    this.restartInterval();
                },
                prev() {
                    this.activeSlide = (this.activeSlide - 1 + this.banners.length) % this.banners.length;
                    this.restartInterval();
                },
                restartInterval() {
                    clearInterval(this.interval);
                    this.interval = setInterval(() => this.next(), 5000);
                },
                init() {
                    this.interval = setInterval(() => this.next(), 5000);
                }
            }
        }
    </script>
</x-site-layout>
