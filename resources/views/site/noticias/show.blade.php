<x-site-layout title="{{ $noticia->titulo }}">

    <section class="px-4 py-10 mx-auto font-sans sm:container">
        @if ($noticia)
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">

                <article class="p-6 bg-white rounded-lg shadow-lg lg:col-span-2 md:p-8">

                    <h1 class="mb-3 text-2xl font-bold leading-tight text-teal-800">{{ $noticia->titulo }}</h1>

                    <div class="flex flex-wrap items-center mb-6 text-sm font-normal text-gray-600">
                        <span><i class="far fa-calendar-alt mr-1.5"></i>Publicado em
                            {{ $noticia->publicado_em->format('d/m/Y') }}</span>
                        @if ($noticia->categoria)
                            <span class="mx-2">|</span>
                            <a href="{{ route('site.noticias.index', ['categoria_id' => $noticia->categoria->slug]) }}"
                                class="inline-block px-2.5 py-1 text-xs font-medium text-teal-800 transition bg-teal-100 rounded-full hover:bg-teal-200">
                                <i class="mr-1 fas fa-tag"></i>{{ $noticia->categoria->nome }}
                            </a>
                        @endif
                    </div>

                    @if ($noticia->imagem)
                        <img src="{{ url($noticia->imagem) }}" alt="{{ $noticia->titulo }}"
                            class="object-cover w-full h-auto mb-8 rounded-lg shadow-md">
                    @endif

                    <div class="font-normal leading-relaxed prose prose-lg text-gray-800 max-w-none">
                        {!! $noticia->conteudo !!}
                    </div>
                </article>

                <aside class="mt-8 lg:col-span-1 lg:mt-0">
                    <div class="sticky space-y-8 top-8">

                        <div class="p-6 bg-white rounded-lg shadow-lg">
                            <h3 class="pb-2 mb-4 text-lg font-bold text-gray-900 border-b">Compartilhar</h3>
                            <div class="flex space-x-2">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($noticia->titulo . ' ' . Request::url()) }}"
                                    target="_blank"
                                    class="flex-1 px-3 py-2 text-sm text-center text-white transition duration-300 bg-green-500 rounded-md hover:bg-green-600"><i
                                        class="fab fa-whatsapp"></i></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                                    target="_blank"
                                    class="flex-1 px-3 py-2 text-sm text-center text-white transition duration-300 bg-blue-600 rounded-md hover:bg-blue-700"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($noticia->titulo) }}"
                                    target="_blank"
                                    class="flex-1 px-3 py-2 text-sm text-center text-white transition duration-300 bg-black rounded-md hover:bg-gray-800"><i
                                        class="fab fa-x-twitter"></i></a>
                            </div>
                        </div>

                        @if (isset($outrasNoticias) && $outrasNoticias->count())
                            <div class="p-6 bg-white rounded-lg shadow-lg">
                                <h3 class="pb-2 mb-4 text-lg font-bold text-teal-700 border-b">Leia Também</h3>
                                <ul class="space-y-4">
                                    @foreach ($outrasNoticias as $outra)
                                        <li class="pb-3 border-b border-gray-100 last:border-b-0 last:pb-0">
                                            <a href="{{ route('site.noticias.show', $outra->slug) }}"
                                                class="text-sm font-semibold text-gray-700 transition duration-300 hover:text-teal-600">
                                                {{ $outra->titulo }}
                                            </a>
                                            <p class="mt-1 text-xs text-gray-500">
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
                <a href="{{ route('site.noticias.index') }}"
                    class="inline-flex items-center px-6 py-2 text-base font-medium text-gray-700 transition bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    <i class="mr-2 fas fa-arrow-left"></i> Voltar para Notícias
                </a>
            </div>
        @else
            <div class="p-8 text-center bg-white rounded-lg shadow-md">
                <p class="text-lg font-medium text-gray-700">Notícia não encontrada.</p>
            </div>
        @endif
    </section>

</x-site-layout>
