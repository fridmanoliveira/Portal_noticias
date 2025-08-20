<x-site-layout title="Obras em Andamento">
    <section class="px-4 py-10 mx-auto font-sans sm:container">
        <!-- Filtros -->
        <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-bold text-gray-800">Listar Obras</h2>
            <h3 class="mb-4 text-xl font-semibold text-gray-700">Filtros Avançados</h3>

            <form method="GET" action="{{ route('obras.index') }}" class="mb-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    <!-- Filtro por ano -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ano</label>
                        <select name="ano" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="Todos">Todos os anos</option>
                            @foreach($anosDisponiveis as $ano)
                                <option value="{{ $ano }}" {{ $filtros['ano'] == $ano ? 'selected' : '' }}>{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="Todos os status">Todos os status</option>
                            @foreach($statusDisponiveis as $status)
                                <option value="{{ $status }}" {{ $filtros['status'] == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botão de aplicar filtros -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-2 text-white bg-[#047a85] rounded-md hover:bg-[#0596A2]">
                            Filtrar
                        </button>
                    </div>
                </div>

                <!-- Busca textual -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Buscar</label>
                    <div class="flex mt-1">
                        <input type="text" name="search" value="{{ $filtros['search'] }}"
                               class="flex-1 border-gray-300 shadow-sm rounded-l-md"
                               placeholder="Digite para buscar...">
                        <button type="submit" class="px-4 text-white bg-[#047a85] rounded-r-md hover:bg-[#0596A2]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            <p class="text-sm text-gray-500">Última atualização em: {{ now()->format('d/m/Y \à\s H:i') }}</p>
        </div>

        <!-- Lista de Obras -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex flex-col justify-between mb-4 space-y-4 md:items-center md:flex-row md:space-y-0">
                <h3 class="text-xl font-semibold text-gray-700">Obras Cadastradas</h3>
                <div class="text-sm text-gray-500">
                    Mostrando {{ $obras->firstItem() }} a {{ $obras->lastItem() }} de {{ $obras->total() }} registros
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Título</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Imagens</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Período</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Progresso</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Responsável</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($obras as $obra)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($obra->descricao, 50) }}</div>
                                <div class="text-xs text-gray-500">{{ $obra->situacao }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($obra->imagens->count() > 0)
                                    <div class="flex -space-x-2">
                                        @foreach($obra->imagens->take(3) as $imagem)
                                            <img src="{{ asset($imagem->image_path) }}"
                                                 class="object-cover w-10 h-10 border-2 border-white rounded-full"
                                                 alt="Imagem da obra {{ $obra->descricao }}"
                                                 title="{{ $obra->descricao }}">
                                        @endforeach
                                        @if($obra->imagens->count() > 3)
                                            <span class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-500 border-2 border-white rounded-full">
                                                +{{ $obra->imagens->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">Sem imagens</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $obra->data_inicio_formatada }}</div>
                                <div class="text-xs text-gray-500">até {{ $obra->data_conclusao_formatada }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-20 mr-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full
                                                @if($obra->etapa_atual == 100) bg-green-600
                                                @elseif($obra->etapa_atual > 70) bg-[#047a85]
                                                @elseif($obra->etapa_atual > 30) bg-yellow-500
                                                @else bg-red-500
                                                @endif"
                                                style="width: {{ $obra->etapa_atual }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $obra->etapa_atual }}%</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $obra->empresa->nome }}</div>
                                <div class="text-xs text-gray-500">{{ $obra->empresa->cnpj }}</div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $obra->valor_formatado }}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('obras.show', $obra->id) }}" class="tebg-[#047a85] hover:text-blue-900">
                                    Detalhes
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                Nenhuma obra encontrada com os filtros aplicados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            @if($obras->hasPages())
            <div class="px-4 py-4 border-t border-gray-200 sm:px-6">
                {{ $obras->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- Seção de destaques -->
    <section class="py-12 bg-gray-50">
        <div class="px-4 mx-auto sm:container">
            <h2 class="mb-8 text-2xl font-bold text-center text-gray-800">Obras em Destaque</h2>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($obras->take(3) as $obra)
                <div class="overflow-hidden transition transform bg-white rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1">
                    <div class="relative h-48">
                        @if($obra->imagens->isNotEmpty())
                            <img src="{{ asset($obra->imagens->first()->image_path) }}"
                                 alt="{{ $obra->descricao }}"
                                 class="object-cover w-full h-full">
                        @else
                            <img src="https://source.unsplash.com/random/600x400?construction,{{ $loop->index }}"
                                 alt="{{ $obra->descricao }}"
                                 class="object-cover w-full h-full">
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 p-2 text-sm font-semibold text-white bg-black bg-opacity-50">
                            {{ $obra->fonte_recurso }}
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="mb-2 text-lg font-semibold text-gray-800">{{ Str::limit($obra->descricao, 60) }}</h3>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-600">{{ $obra->empresa->nome }}</span>
                            <span class="text-sm font-semibold tebg-[#047a85]">{{ $obra->valor_formatado }}</span>
                        </div>
                        <div class="w-full mb-2 bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full
                                @if($obra->etapa_atual == 100) bg-green-600
                                @else bg-[#047a85]
                                @endif"
                                style="width: {{ $obra->etapa_atual }}%">
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>Início: {{ $obra->data_inicio_formatada }}</span>
                            <span>{{ $obra->etapa_atual }}% concluído</span>
                        </div>
                        <a href="{{ route('obras.show', $obra->id) }}"
                           class="inline-block w-full mt-4 text-center btn btn-primary">
                            Ver detalhes
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="map" class="w-full rounded-lg shadow-md h-96"></div>

    {{-- <!-- Mapa -->
    <section class="py-8 bg-white">
        <div class="px-4 mx-auto sm:container">
            <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">Localização das Obras</h2>
            <div class="w-full overflow-hidden rounded-lg shadow-md h-80">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.093055709833!2d-44.071543!3d-7.409391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x789e0b1f2e1a3d3%3A0x2a9d821a719d263a!2sCristino%20Castro%2C%20PI!5e0!3m2!1spt-BR!2sbr!4v1722421389924!5m2!1spt-BR!2sbr"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section> --}}
    <script>
        var map = L.map('map').setView([-7.409391, -44.071543], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        @foreach($obras as $obra)
            @if($obra->latitude && $obra->longitude)
                L.marker([{{ $obra->latitude }}, {{ $obra->longitude }}])
                    .addTo(map)
                    .bindPopup("<b>{{ $obra->descricao }}</b><br>{{ $obra->empresa->nome }}");
            @endif
        @endforeach
    </script>
</x-site-layout>
