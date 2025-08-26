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

    <!-- Início da Seção de Notícias e Links -->
    <section class="px-4 py-6 mx-auto sm:container">
        <!-- Título da Seção -->
        <div class="flex items-center justify-between">
            <h2 class="mb-4 text-lg font-extrabold tracking-tight text-gray-800 uppercase sm:mb-6">
                ÚLTIMAS NOTÍCIAS
            </h2>
            <a href="{{ route('site.noticias.index') }}"
            class="text-sm font-medium text-teal-600 transition sm:text-base hover:text-teal-800">
                Ver todas →
            </a>
        </div>

        <!-- Container Principal (Duas colunas) -->
        <div class="flex flex-col gap-8 lg:flex-row">
            <!-- Coluna da Esquerda: Carrossel de Notícias -->
            <div class="w-full lg:w-2/3"
                x-data="{
                    noticias: {{ Js::from($noticiasCarrossel) }},
                    activeIndex: 0,
                    autoplay: null,
                    init() {
                        if (this.noticias.length > 1) this.startAutoplay();
                    },
                    startAutoplay() {
                        this.autoplay = setInterval(() => this.next(), 5000);
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

                <div class="relative h-full overflow-hidden rounded-lg shadow-lg min-h-96">
                    <!-- Slides -->
                    <template x-for="(noticia, index) in noticias" :key="noticia.slug">
                        <div x-show="activeIndex === index"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 flex items-end w-full h-full">
                            <img :src="noticia.imagem"
                                :alt="noticia.titulo"
                                class="object-cover w-full h-full">
                            <div class="absolute bottom-0 left-0 p-6 text-white">
                                <a :href="'/noticias/' + noticia.slug" class="block">
                                    <h1 class="text-xl font-bold leading-tight sm:text-xl">
                                        <span class="px-2 py-1 text-white bg-[#005d6d] rounded box-decoration-clone italic" x-text="noticia.titulo"></span>
                                    </h1>
                                </a>
                            </div>
                        </div>
                    </template>

                    <!-- Controles no canto superior direito -->
                    <template x-if="noticias.length > 1">
                        <div class="absolute z-20 flex items-center px-2 py-1 space-x-2 rounded-full top-4 right-4 bg-black/30 backdrop-blur-sm">
                            <!-- Botão Anterior -->
                            <button @click="prev()"
                                    class="text-white transition-transform hover:scale-110 focus:outline-none">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>

                            <!-- Bolinhas -->
                            <template x-for="(noticia, index) in noticias" :key="'dot-' + noticia.slug">
                                <button @click="goTo(index)"
                                        class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full transition-all duration-200"
                                        :class="{
                                            'bg-white': activeIndex === index,
                                            'bg-white/50 hover:bg-white/75': activeIndex !== index
                                        }"></button>
                            </template>

                            <!-- Botão Próximo -->
                            <button @click="next()"
                                    class="text-white transition-transform hover:scale-110 focus:outline-none">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Coluna da Direita: Links Rápidos -->
            <div class="flex flex-col w-full gap-4 lg:w-1/3">
                @foreach([
                    ['icon' => url('icons/searching.png'), 'text' => 'PORTAL DA<br>TRANSPARÊNCIA', 'url' => '#'],
                    ['icon' => url('icons/support.png'), 'text' => 'OUVIDORIA DE<br>CRISTINO CASTRO', 'url' => '#'],
                    ['icon' => url('icons/radar.png'), 'text' => 'RADAR NACIONAL DA<br>TRANSPARÊNCIA PÚBLICA', 'url' => '#']
                ] as $link)
                <a href="{{ $link['url'] }}"
                class="flex items-center flex-grow gap-3 px-4 py-4 text-white rounded-lg shadow-sm transition-all hover:shadow-md bg-gradient-to-r from-[#008f9c] to-[#005d6d] sm:gap-4 sm:px-6 sm:py-5 sm:rounded-lg sm:shadow-md">
                    <img src="{{ $link['icon'] }}" alt="" class="w-8 h-8 sm:w-12 sm:h-12">
                    <p class="text-sm font-bold leading-tight sm:text-base">{!! $link['text'] !!}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Fim da Seção de Notícias -->

    <!-- Acesso Rápido - Responsivo -->
    <section class="px-2 py-6 mx-auto sm:container max-w-7xl sm:py-12" id="servicos">
        <h2 class="mb-4 text-lg font-extrabold tracking-tight text-gray-800 uppercase sm:mb-6">
            Acesso Rápido
        </h2>

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-1 sm:gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($acessosRapidos as $acesso)
            <a href="{{ $acesso->link }}"
            class="flex flex-col items-start p-4 text-white transition-transform duration-300 rounded-lg shadow-sm bg-gradient-to-r from-[#008f9c] to-[#005d6d] hover:scale-[1.03] sm:p-6 sm:hover:scale-105">

                <img src="{{ url($acesso->icone) }}"
                    alt="{{ $acesso->titulo }}"
                    class="w-8 h-8 mb-2 sm:w-10 sm:h-10 sm:mb-4 svg-branco">

                <h2 class="text-sm font-semibold leading-tight">
                    {{ $acesso->titulo }}
                </h2>

                <p class="hidden mt-2 text-xs font-light opacity-80 sm:block sm:text-sm">
                    Clique para acessar
                </p>
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

    <!-- História - Responsivo -->
    @if(isset($video))
    <section class="relative bg-center bg-cover" style="background-image: url('{{ url('fundo.png') }}')">
        <div class="bg-teal-900 bg-opacity-70">
            <div class="grid items-center grid-cols-1 gap-6 px-4 py-8 mx-auto sm:container md:grid-cols-2 sm:gap-10 sm:py-16">

                <div class="text-white" x-data="{ open: false }">
                    <h2 class="text-2xl font-extrabold leading-tight sm:text-3xl sm:leading-snug">
                        {{ $video->titulo ?? 'A História de Cristino Castro' }}
                    </h2>

                    <div class="mt-3 text-sm leading-relaxed sm:text-base sm:mb-4">
                        {!! \Illuminate\Support\Str::limit(strip_tags($video->descricao), 200) !!}
                    </div>

                    <a href="{{ route('site.historia', $video->slug) }}"
                            class="mt-2 text-sm font-semibold text-green-300 underline transition hover:text-green-200 sm:mt-0 sm:text-base">
                        Continue lendo...
                    </a>
                </div>

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
                            <p class="text-sm text-gray-400">Vídeo não disponível</p>
                        </div>
                    @endif
                </div>
            </div>

            @if(isset($turismo->pdf))
                <div class="py-4 text-center sm:py-6">
                    <a href="{{ asset($turismo->pdf) }}" target="_blank"
                        class="inline-block px-4 py-2 text-sm font-semibold text-white transition bg-[#1DC98A] rounded-md shadow-md hover:bg-opacity-70 sm:px-6 sm:py-3 sm:text-base sm:bg-[#1DC98A] sm:hover:bg-[#1DC98A]/80">
                        VEJA TAMBÉM O INVENTÁRIO DA OFERTA TURÍSTICA
                    </a>
                </div>
            @endif
        </div>
    </section>
@endif

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
