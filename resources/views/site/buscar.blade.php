<x-site-layout title="Resultados da busca">
    <section class="px-4 py-6 mx-auto sm:container">
        <!-- Título -->
        <h1 class="mb-6 text-lg font-extrabold tracking-tight text-gray-800 uppercase">
            Resultados da Busca
        </h1>

        <!-- Termo pesquisado -->
        @if ($query)
            <p class="mb-6 text-sm text-gray-700 sm:text-base">
                Você pesquisou por:
                <span class="px-2 py-1 font-semibold text-white rounded bg-[#005d6d]">
                    {{ $query }}
                </span>
            </p>
        @endif

        <!-- Resultados -->
        @if ($resultados->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($resultados as $item)
                    <div class="p-5 transition bg-white rounded-lg shadow-sm hover:shadow-md">
                        <a href="{{ $item['url'] }}"
                           class="block mb-2 text-base font-semibold text-[#005d6d] hover:underline">
                            [{{ ucfirst($item['tipo']) }}] {{ $item['titulo'] }}
                        </a>

                        @if ($item['conteudo'])
                            <p class="text-sm text-gray-600">
                                {{ Str::limit(strip_tags($item['conteudo']), 120) }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-8">
                {{ $resultados->links() }}
            </div>
        @else
            <div class="p-6 text-center bg-gray-100 border border-gray-200 rounded-lg">
                <p class="text-gray-600">Nenhum resultado encontrado.</p>
            </div>
        @endif
    </section>
</x-site-layout>
