<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-[#0596A2]/10">
                    <svg class="w-6 h-6 text-[#0596A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Painel de Respostas - PPA</h2>
                    <p class="text-sm text-gray-500">Análise das respostas do PPA Participativo</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Cards de estatísticas -->
            <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Total de Pessoas -->
                <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-base font-medium text-gray-700">Total de Respostas</h3>
                    </div>
                    <div class="px-6 py-5">
                        <p class="text-3xl font-bold text-[#0596A2]">{{ $totalPessoas }}</p>
                        <p class="mt-1 text-sm text-gray-500">Pessoas participaram</p>
                    </div>
                </div>

                <!-- Total de Perguntas -->
                <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-base font-medium text-gray-700">Perguntas</h3>
                    </div>
                    <div class="px-6 py-5">
                        <p class="text-3xl font-bold text-[#0596A2]">{{ count($data) }}</p>
                        <p class="mt-1 text-sm text-gray-500">Perguntas na pesquisa</p>
                    </div>
                </div>

                <!-- Última Resposta -->
                <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-base font-medium text-gray-700">Última Resposta</h3>
                    </div>
                    <div class="px-6 py-5">
                        @if($totalPessoas > 0)
                            <p class="text-3xl font-bold text-[#0596A2]">{{ $ultimaResposta->created_at->format('d/m') }}</p>
                            <p class="mt-1 text-sm text-gray-500">às {{ $ultimaResposta->created_at->format('H:i') }}</p>
                        @else
                            <p class="text-lg font-medium text-gray-500">Nenhuma resposta</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Lista de Perguntas e Respostas -->
            @foreach($data as $questionId => $answers)
                <div class="mb-8 overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                    <!-- Cabeçalho da Pergunta -->
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-700">
                            <span class="font-bold text-[#0596A2]">P{{ $loop->iteration }}.</span>
                            {{ $answers->first()->question_title }}
                        </h3>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            <!-- Gráfico -->
                            <div>
                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-gray-700">Distribuição das Respostas</h4>
                                        <span class="text-xs text-gray-500">{{ $totalPessoas }} respostas</span>
                                    </div>
                                </div>
                                <div class="relative h-64">
                                    <canvas id="chart-{{ $questionId }}"></canvas>
                                </div>
                            </div>

                            <!-- Tabela -->
                            <div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-700">Detalhamento por Opção</h4>
                                </div>
                                <div class="overflow-auto border border-gray-200 rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">Opção</th>
                                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">Outros</th>
                                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">Total</th>
                                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">%</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($answers as $answer)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $answer->option_text ?? 'Outro' }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                                                        @if($answer->other_text)
                                                            <span class="italic">{{ Str::limit($answer->other_text, 30) }}</span>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 text-sm font-bold text-center text-[#0596A2] whitespace-nowrap">{{ $answer->total_respostas }}</td>
                                                    <td class="px-4 py-3 text-sm text-center text-gray-500 whitespace-nowrap">{{ $answer->percentage }}%</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Script do Gráfico -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx = document.getElementById('chart-{{ $questionId }}');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode($answers->pluck('option_text')->map(fn($v) => Str::limit($v ?? 'Outro', 30))) !!},
                                datasets: [{
                                    label: 'Respostas',
                                    data: {!! json_encode($answers->pluck('total_respostas')) !!},
                                    backgroundColor: '#0596A2',
                                    borderRadius: 4,
                                    barThickness: 20
                                }]
                            },
                            options: {
                                indexAxis: 'y',
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const percentage = {!! json_encode($answers->pluck('percentage')) !!}[context.dataIndex];
                                                return `${context.raw} (${percentage}%)`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0,
                                            stepSize: 1
                                        },
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        grid: {
                                            display: false
                                        },
                                        ticks: {
                                            autoSkip: false
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>
            @endforeach
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</x-app-layout>
