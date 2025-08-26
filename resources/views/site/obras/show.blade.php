<x-site-layout :title="$obra->descricao">
    <section class="px-4 py-8 mx-auto font-sans sm:container">
        <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
            <div class="flex flex-col items-start justify-between mb-6 md:flex-row md:items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $obra->descricao }}</h1>
                    <p class="text-gray-600">Código: {{ $obra->codigo ?? 'N/A' }}</p>
                </div>
                <span
                    class="px-4 py-2 mt-4 text-sm font-semibold rounded-full md:mt-0
                    @if ($obra->situacao == 'Concluída') bg-green-100 text-green-800
                    @elseif($obra->situacao == 'Em Andamento') bg-yellow-100 text-yellow-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ $obra->situacao }}
                </span>
            </div>

            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-500">Data de Início</p>
                    <p class="font-semibold">{{ $obra->data_inicio_formatada }}</p>
                </div>
                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-500">Previsão de Término</p>
                    <p class="font-semibold">{{ $obra->data_conclusao_formatada }}</p>
                </div>
                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-500">Valor Total</p>
                    <p class="font-semibold">
                         @php
                            $valorTotal = $obra->valor_aditado ? $obra->valor + $obra->valor_aditado : $obra->valor;
                        @endphp
                        <span>R$ {{ number_format($valorTotal, 2, ',', '.') }}</span>
                    </p>
                </div>

                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-500">Valor Aditado</p>
                    <p class="font-semibold">R$ {{ number_format($obra->valor_aditado, 2, ',', '.') }}</p>
                </div>

                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-500">Prazo Aditado</p>
                    <p class="font-semibold">{{ $obra->prazo_aditado }} Dias</p>
                </div>
                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-500">Fonte de Recurso</p>
                    <p class="font-semibold">{{ $obra->fonte_recurso ?? 'Não informado' }}</p>
                </div>

            </div>

            <div class="mb-6">
                <h3 class="mb-2 text-lg font-semibold text-gray-800">Progresso da Obra</h3>
                <div class="flex items-center">
                    <div class="w-full h-2.5 mr-4 bg-gray-200 rounded-full">
                        <div class="h-2.5 rounded-full
                            @if ($progresso == 100) bg-green-600
                            @elseif($progresso > 70) bg-blue-600
                            @elseif($progresso > 30) bg-yellow-500
                            @else bg-red-500 @endif progress-bar"
                            style="width: {{ $progresso }}%">
                        </div>
                    </div>
                    <span class="text-lg font-bold">{{ $progresso }}%</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
                    <div
                        class="flex flex-col items-start justify-between mb-6 space-y-2 md:flex-row md:items-center md:space-y-0">
                        <h2 class="text-xl font-bold text-gray-800">Andamentos da Obra</h2>
                        <div class="flex space-x-2">
                            <select id="filter-status" class="px-3 py-2 text-sm border rounded-lg">
                                <option value="">Todos</option>
                                <option value="completed">Concluído</option>
                                <option value="in-progress">Em Andamento</option>
                                <option value="planned">Planejado</option>
                            </select>
                        </div>
                    </div>

                    <div id="andamentos-container" class="timeline">
                        @foreach ($andamentos as $andamento)
                            @php
                                $statusClass = match (true) {
                                    $andamento->progresso == 100 => 'completed',
                                    $andamento->progresso > 0 && $andamento->progresso < 100 => 'in-progress',
                                    default => 'planned',
                                };

                                $statusLabel = match (true) {
                                    $andamento->progresso == 0 => ['Planejado', 'gray'],
                                    $andamento->progresso > 0 && $andamento->progresso <= 25 => ['Início', 'red'],
                                    $andamento->progresso > 25 && $andamento->progresso <= 50 => ['Em Andamento', 'yellow'],
                                    $andamento->progresso > 50 && $andamento->progresso <= 75 => ['Avançado', 'orange'],
                                    $andamento->progresso > 75 && $andamento->progresso < 100 => ['Quase Concluído', 'blue'],
                                    $andamento->progresso == 100 => ['Concluído', 'green'],
                                    default => ['Planejado', 'gray'],
                                };
                            @endphp

                            <div class="timeline-item {{ $statusClass }}">
                                <div class="p-4 mb-4 rounded-lg bg-gray-50">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="font-semibold text-gray-800">{{ $andamento->titulo }}</h3>
                                        <span class="text-sm text-gray-500">
                                            {{ $andamento->data ? \Carbon\Carbon::parse($andamento->data)->format('d/m/Y') : 'Próxima etapa' }}
                                        </span>
                                    </div>

                                    <p class="mb-3 text-gray-600">{{ $andamento->descricao }}</p>

                                    @if (is_array($andamento->tags) && count($andamento->tags) > 0)
                                        <div class="flex items-center mb-3 space-x-2">
                                            @foreach ($andamento->tags as $tag)
                                                <span
                                                    class="px-2 py-1 text-xs {{ $tag['color'] ?? 'text-blue-800' }} {{ $tag['bg'] ?? 'bg-blue-100' }} rounded-full">
                                                    {{ $tag['name'] }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-between">
                                        <span
                                            class="px-2 py-1 text-xs text-{{ $statusLabel[1] }}-800 bg-{{ $statusLabel[1] }}-100 rounded-full">
                                            <i
                                                class="mr-1 fas fa-{{ $statusLabel[0] == 'Concluído' ? 'check-circle' : ($statusLabel[0] == 'Em Andamento' ? 'spinner' : 'clock') }}"></i>
                                            {{ $statusLabel[0] }}
                                        </span>
                                        <span class="text-sm font-semibold text-blue-600">Progresso:
                                            {{ $andamento->progresso }}%</span>

                                        <a href="{{ asset($andamento->anexo) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#047a85] rounded-lg shadow hover:bg-[#065e6a] transition">
                                                <!-- Ícone de clipe -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 12.79V17a4 4 0 01-8 0V7a2 2 0 114 0v10a2 2 0 11-4 0" />
                                                </svg>
                                                Anexo
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-xl font-bold text-gray-800">Galeria de Fotos</h2>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($galeria as $foto)
                            <div class="overflow-hidden bg-gray-200 rounded-lg aspect-square">
                                <img src="{{ $foto['url'] }}" alt="{{ $foto['legenda'] }}"
                                    class="object-cover w-full h-full">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-xl font-bold text-gray-800">Empresa Responsável</h2>
                    <p class="font-semibold">{{ $obra->empresa->nome }}</p>
                    <p class="text-sm text-gray-600">
                        CNPJ:
                        {{ $obra->empresa->cnpj ? preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $obra->empresa->cnpj) : 'Não informado' }}
                    </p>
                    <p class="text-sm text-gray-600">Responsável: {{ $obra->empresa->responsavel_legal }}</p>
                </div>

                <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-xl font-bold text-gray-800">Fiscal Técnico</h2>
                    <p class="font-semibold">{{ $obra->fiscal->nome ?? 'Não designado' }}</p>
                    @if ($obra->fiscal)
                        <p class="text-sm text-gray-600">CREA: {{ $obra->fiscal->crea }}</p>
                        <p class="text-sm text-gray-600">
                            CPF:
                            {{ $obra->fiscal->cpf ? preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $obra->fiscal->cpf) : 'Não informado' }}
                        </p>
                    @endif
                </div>

                <div class="p-0 mb-6 overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-bold text-gray-800">Localização da Obra</h2>
                    </div>
                    <div id="map-container" class="relative">
                        <div id="map-loading"
                            class="absolute inset-0 z-10 flex items-center justify-center bg-gray-100">
                            <div class="text-center">
                                <div
                                    class="inline-block w-8 h-8 border-4 border-blue-500 rounded-full border-t-transparent animate-spin">
                                </div>
                                <p class="mt-2 text-gray-600">Carregando mapa...</p>
                            </div>
                        </div>
                        <div id="map-error"
                            class="absolute inset-0 z-10 items-center justify-center hidden bg-gray-100 p-7">
                            <div class="text-center text-gray-600">
                                <i class="mb-3 text-4xl text-gray-400 fas fa-map-marker-alt"></i>
                                <p>Localização não disponível para esta obra.</p>
                            </div>
                        </div>
                        <div id="map" class="w-full rounded-b-lg h-96"></div>
                    </div>
                    <div id="map-address" class="p-3 text-sm text-center text-gray-600 bg-gray-50"></div>
                </div>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p41B+8XF+8W9w1T8S9f8L8w/1S6W9yF6f4b5+4V5b2A=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-2L+76O6w6X6p5+2b8+7L8j5+5X8F7+8W6e7+5V6b2A=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.querySelector('.progress-bar');
            let width = 0;
            const targetWidth = {{ $progresso }};
            const interval = setInterval(() => {
                if (width >= targetWidth) clearInterval(interval);
                else {
                    width++;
                    progressBar.style.width = width + '%';
                }
            }, 20);

            const filterSelect = document.getElementById('filter-status');
            const container = document.getElementById('andamentos-container');
            const items = Array.from(container.children);

            function render() {
                const statusFilter = filterSelect.value;
                items.forEach(item => {
                    if (statusFilter === '' || item.classList.contains(statusFilter)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            filterSelect.addEventListener('change', render);

            setTimeout(initMap, 500);
        });

        function initMap() {
            const mapLoading = document.getElementById('map-loading');
            const mapError = document.getElementById('map-error');
            const mapAddress = document.getElementById('map-address');

            if ({{ $obra->latitude ?? 'false' }} && {{ $obra->longitude ?? 'false' }}) {
                const latitude = {{ $obra->latitude }};
                const longitude = {{ $obra->longitude }};

                var map = L.map('map').setView([latitude, longitude], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([latitude, longitude]).addTo(map);

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`)
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(data => {
                        mapAddress.textContent = data.display_name || 'Endereço não disponível';
                        mapLoading.style.display = 'none';
                        map.invalidateSize();
                    })
                    .catch(() => {
                        mapAddress.textContent = 'Endereço não disponível';
                        mapLoading.style.display = 'none';
                    });
            } else {
                mapLoading.style.display = 'none';
                mapError.style.display = 'flex';
            }
        }
    </script>

    <style>
        .timeline {
            position: relative;
            padding-left: 3rem;
            margin: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -3rem;
            top: 0.5rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #3b82f6;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #3b82f6;
        }

        .timeline-item.completed::before {
            background-color: #10b981;
            box-shadow: 0 0 0 2px #10b981;
        }

        .timeline-item.in-progress::before {
            background-color: #f59e0b;
            box-shadow: 0 0 0 2px #f59e0b;
        }

        .timeline-item.planned::before {
            background-color: #6b7280;
            box-shadow: 0 0 0 2px #6b7280;
        }

        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>
</x-site-layout>
