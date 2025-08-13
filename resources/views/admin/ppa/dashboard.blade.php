<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="text-3xl">📈</span>
            <h2 class="text-2xl font-bold text-gray-800">Painel de Respostas - PPA</h2>
        </div>
    </x-slot>

    <div class="space-y-10 cp-6 sm:container">

        {{-- Cards de estatísticas rápidas --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div class="p-5 bg-white border shadow-lg rounded-xl">
                <h4 class="text-sm text-gray-500 uppercase">Total de Pessoas que Responderam</h4>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalPessoas }}</p>
            </div>

            <div class="p-5 bg-white border shadow-lg rounded-xl">
                <h4 class="text-sm text-gray-500 uppercase">Perguntas</h4>
                <p class="text-3xl font-bold text-indigo-600">{{ count($data) }}</p>
            </div>
            <div class="p-5 bg-white border shadow-lg rounded-xl">
                <h4 class="text-sm text-gray-500 uppercase">Última Resposta</h4>
                <p class="text-lg font-bold text-indigo-600">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @foreach($data as $questionId => $answers)
            <div class="p-6 bg-white border shadow-xl rounded-xl">
                <h3 class="mb-6 text-xl font-semibold text-gray-700">{{ $answers->first()->question_title }}</h3>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

                    {{-- Gráfico --}}
                    <div>
                        <canvas id="chart-{{ $questionId }}" height="200"></canvas>
                    </div>

                    {{-- Tabela --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                            <thead class="text-xs text-gray-600 uppercase bg-gray-50">
                                <tr>
                                    <th class="p-3 text-left">Opção</th>
                                    <th class="p-3 text-left">Outros</th>
                                    <th class="p-3 text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($answers as $answer)
                                    <tr>
                                        <td class="p-3">{{ $answer->option_text ?? 'Outro' }}</td>
                                        <td class="p-3 italic text-gray-500">{{ $answer->other_text ?? '-' }}</td>
                                        <td class="p-3 font-bold text-center text-indigo-600">{{ $answer->total_respostas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            {{-- Script gráfico de barras horizontais --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const ctx = document.getElementById('chart-{{ $questionId }}').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($answers->pluck('option_text')->map(fn($v) => $v ?? 'Outro')) !!},
                            datasets: [{
                                label: 'Respostas',
                                data: {!! json_encode($answers->pluck('total_respostas')) !!},
                                backgroundColor: '#4f46e5',
                                borderRadius: 6
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: { stepSize: 1 }
                                }
                            }
                        }
                    });
                });
            </script>
        @endforeach
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</x-app-layout>
