<x-site-layout title="Mapas da Cidade">
    <section class="px-4 py-10 mx-auto font-sans sm:container">
        <ul class="flex mb-6 space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('site.home') }}" class="hover:text-gray-700">Início</a></li>
            <li>/</li>
            <li class="font-semibold text-gray-700">Mapas da Cidade</li>
        </ul>

        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">

            {{-- Conteúdo Principal com a Grade de Mapas --}}
            <div class="lg:col-span-2">
                <div class="p-6 bg-white rounded-lg shadow-lg md:p-8">
                    <h1 class="mb-6 text-2xl font-bold leading-tight text-teal-800 border-b pb-4">Mapas da Cidade</h1>

                    {{-- Grid para os cards dos mapas --}}
                    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
                        @forelse ($mapas as $mapa)
                            <div class="flex flex-col p-5 transition duration-300 bg-gray-50 border rounded-lg shadow-sm hover:shadow-lg hover:-translate-y-1">
                                {{-- Título do Mapa --}}
                                <h3 class="text-lg font-semibold text-gray-800">{{ $mapa->titulo }}</h3>

                                {{-- Descrição --}}
                                <div class="flex-grow mt-2 text-sm text-gray-600 prose max-w-none">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($mapa->descricao), 150) !!}
                                </div>

                                {{-- Botão do PDF --}}
                                <div class="mt-4">
                                    <a href="{{ asset($mapa->arquivo_pdf) }}" target="_blank" class="inline-block w-full px-4 py-2 text-sm font-semibold text-center text-white transition bg-teal-600 rounded-md shadow-sm hover:bg-teal-700">
                                        {{ $mapa->texto_botao }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center md:col-span-2">
                                <p class="text-gray-500">Nenhum mapa disponível no momento.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>


            {{-- Barra Lateral de Notícias --}}
            <aside class="mt-8 lg:col-span-1 lg:mt-0">
                <div class="sticky space-y-6 top-8">
                    <h2 class="text-xl font-bold text-teal-800">Notícias</h2>
                    @if (isset($noticias) && $noticias->count())
                        <ul class="space-y-6">
                            @foreach ($noticias as $noticia)
                                <li class="p-4 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg hover:scale-105">
                                    <a href="{{ route('site.noticias.show', $noticia->slug) }}">
                                        @if ($noticia->imagem)
                                            <img src="{{ url($noticia->imagem) }}" alt="{{ $noticia->titulo }}" class="object-cover w-full h-32 mb-3 rounded-md">
                                        @endif
                                        <span class="block font-semibold text-gray-800 hover:text-teal-600">
                                            {{ \Illuminate\Support\Str::limit($noticia->titulo, 60) }}
                                        </span>
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $noticia->publicado_em->format('d/m/Y') }}
                                        </p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="p-4 text-gray-600 bg-gray-100 rounded-lg">Nenhuma notícia encontrada.</p>
                    @endif
                </div>
            </aside>

        </div>
    </section>
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
