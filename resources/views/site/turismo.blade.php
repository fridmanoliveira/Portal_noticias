<x-site-layout title="Turismo">

    <section class="px-4 py-10 mx-auto font-sans sm:container">
        @if ($turismo)
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">

                <article class="p-6 bg-white rounded-lg shadow-lg lg:col-span-2 md:p-8">
                    <h1 class="mb-3 text-2xl font-bold leading-tight text-teal-800">{{ $turismo->titulo }}</h1>

                    <div class="mb-6 leading-relaxed prose prose-lg text-gray-700 max-w-none ">
                        {!! $turismo->descricao !!}
                    </div>

                    @if(isset($turismo->imagens) && $turismo->imagens->count() > 0)
                        <div class="relative max-w-6xl mx-auto" x-data="gallerySlider()">
                            <div class="overflow-hidden rounded-lg shadow-lg h-72 sm:h-96">
                                <template x-for="(foto, index) in fotos" :key="index">
                                    <img x-show="currentIndex === index" :src="foto + '?w=800&h=600&fit=crop'"
                                        alt="Imagens de turismo"
                                        class="object-cover w-full h-full transition-opacity duration-700"
                                        style="display: none;" x-transition:enter="transition ease-out duration-700"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-700"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" />
                                </template>
                            </div>

                            <button @click="prev()"
                                class="absolute p-2 transform -translate-y-1/2 bg-white rounded-full shadow top-1/2 left-2 bg-opacity-70 hover:bg-opacity-100 focus:outline-none"
                                aria-label="Imagem anterior">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6" />
                                </svg>
                            </button>

                            <button @click="next()"
                                class="absolute p-2 transform -translate-y-1/2 bg-white rounded-full shadow top-1/2 right-2 bg-opacity-70 hover:bg-opacity-100 focus:outline-none"
                                aria-label="Próxima imagem">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                            </button>

                            <div class="flex justify-center mt-6 space-x-3">
                                <template x-for="(foto, index) in fotos" :key="'dot-' + index">
                                    <button @click="goTo(index)"
                                        :class="{ 'bg-teal-700': currentIndex === index, 'bg-gray-300': currentIndex !== index }"
                                        class="w-3 h-3 rounded-full focus:outline-none"
                                        aria-label="Ir para imagem"></button>
                                </template>
                            </div>
                        </div>
                    @else
                        <div class="py-8 text-center">
                            <p class="text-sm text-gray-500">Nenhuma foto disponível para esta página.</p>
                        </div>
                    @endif

                    @if ($turismo->pdf)
                    <div class="py-4 text-center sm:py-6">
                        <a href="{{ asset($turismo->pdf) }}" target="_blank"
                            class="inline-block px-4 py-2 text-sm font-semibold text-white transition bg-[#1DC98A] rounded-md shadow-md hover:bg-opacity-70 sm:px-6 sm:py-3 sm:text-base sm:bg-[#1DC98A] sm:hover:bg-[#1DC98A]/80">
                            VEJA TAMBÉM O INVENTÁRIO DA OFERTA TURÍSTICA
                        </a>
                    </div>
                    @endif
                </article>

                <aside class="mt-8 lg:col-span-1 lg:mt-0">
                    <div class="sticky space-y-6 top-8">
                        <h2 class="mb-4 text-xl font-bold text-teal-800">Notícias</h2>
                        @if (isset($noticiasRelacionadas) && $noticiasRelacionadas->count())
                            <ul class="space-y-6">
                                @foreach ($noticiasRelacionadas as $noticia)
                                    <li class="p-4 transition bg-white rounded-lg shadow hover:shadow-md">
                                        @if ($noticia->imagem)
                                            <img src="{{ url($noticia->imagem) }}" alt="{{ $noticia->titulo }}"
                                                class="object-cover w-full h-32 mb-3 rounded">
                                        @endif
                                        <a href="{{ route('site.noticias.show', $noticia->slug) }}"
                                            class="block font-semibold text-gray-800 hover:text-teal-600">
                                            {{ \Illuminate\Support\Str::limit($noticia->titulo, 60) }}
                                        </a>
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $noticia->publicado_em->format('d/m/Y') }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">Nenhuma notícia relacionada encontrada.</p>
                        @endif
                    </div>
                </aside>

            </div>
        @else
            <div class="p-8 text-center bg-white rounded-lg shadow-md">
                <p class="text-lg font-medium text-gray-700">Nenhum conteúdo de turismo foi adicionado ainda.</p>
            </div>
        @endif
    </section>

    @if(isset($turismo) && $turismo->imagens->count() > 0)
        <script>
            function gallerySlider() {
                return {
                    fotos: [
                        @foreach ($turismo->imagens as $imagem)
                            '{{ asset($imagem->image_path) }}',
                        @endforeach
                    ],
                    currentIndex: 0,
                    prev() {
                        this.currentIndex = (this.currentIndex === 0) ? this.fotos.length - 1 : this.currentIndex - 1;
                    },
                    next() {
                        this.currentIndex = (this.currentIndex === this.fotos.length - 1) ? 0 : this.currentIndex + 1;
                    },
                    goTo(index) {
                        this.currentIndex = index;
                    }
                }
            }
        </script>
    @endif

    <section class="py-8">
        <div class="px-4 mx-auto sm:container">
            @if ($bannerPrincipal)
                <img src="{{ url($bannerPrincipal->imagem) }}" alt="Banner Principal" class="w-full rounded shadow-md">
            @else
                <img src="https://placehold.co/1200x300/a3e635/1c1c1c?text=Banner+Principal" alt="Banner Padrão"
                    class="w-full rounded shadow-md">
            @endif
        </div>
    </section>

    <section>
        <div class="w-full overflow-hidden rounded-lg shadow-md h-80">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.093055709833!2d-44.071543!3d-7.409391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x789e0b1f2e1a3d3%3A0x2a9d821a719d263a!2sCristino%20Castro%2C%20PI!5e0!3m2!1spt-BR!2sbr!4v1722421389924!5m2!1spt-BR!2sbr"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</x-site-layout>
