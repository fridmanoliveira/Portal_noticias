<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Lista de Obras</h2>
                <p class="mt-1 text-sm text-gray-500">Gerencie as obras cadastradas no sistema</p>
            </div>
            <a href="{{ route('admin.obras.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-[#0596A2] rounded-lg hover:bg-[#047a85] transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Obra
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-6 rounded-lg bg-green-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex flex-col items-center justify-between md:flex-row">
                        <h3 class="mb-2 text-lg font-medium text-gray-700 md:mb-0">Obras Cadastradas</h3>
                        <form action="{{ route('admin.obras.index') }}" method="GET" class="relative w-full md:w-auto">
                            <input type="text" name="search" placeholder="Buscar obra..."
                                   value="{{ request('search') }}"
                                   class="w-full md:w-64 pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            <svg class="absolute w-5 h-5 text-gray-400 left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </form>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Descrição</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Período</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Progresso</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Situação</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Responsável</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Valor</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($obras as $obra)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <svg class="w-full h-full text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $obra->descricao }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $obra->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($obra->data_inicio)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($obra->data_conclusao)->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            // Acessa o primeiro (e único) item da coleção andamentos
                                            $progresso = $obra->andamentos->first()->progresso ?? 0;
                                            $corProgresso = match(true) {
                                                $progresso < 30 => 'bg-red-500',
                                                $progresso < 70 => 'bg-yellow-500',
                                                $progresso < 100 => 'bg-orange-500',
                                                default => 'bg-blue-500'
                                            };
                                        @endphp
                                        <div class="flex items-center">
                                            <div class="w-16 mr-3 text-sm text-gray-500">{{ $progresso }}%</div>
                                            <div class="flex-1">
                                                <div class="w-full h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 rounded-full {{ $corProgresso }}" style="width: {{ $progresso }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full
                                            @if($obra->situacao == 'Em andamento') text-green-800 bg-green-100
                                            @elseif($obra->situacao == 'Concluída') text-blue-800 bg-blue-100
                                            @elseif($obra->situacao == 'Atrasada') text-red-800 bg-red-100
                                            @else text-gray-800 bg-gray-100
                                            @endif">
                                            {{ $obra->situacao }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $obra->empresa->nome ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        R$ {{ number_format($obra->valor, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">

                                            <a href="{{ route('admin.obras.andamentos.index', $obra->slug) }}" class="p-2 text-gray-500 transition-colors rounded-full hover:bg-gray-100 hover:text-blue-600" title="Andamentos">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13M9 5h13M5 5h.01M5 11h.01M5 17h.01"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.obras.edit', $obra->slug) }}" class="p-2 text-gray-500 transition-colors rounded-full hover:bg-gray-100 hover:text-yellow-600" title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.obras.destroy', $obra->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-500 transition-colors rounded-full hover:bg-gray-100 hover:text-red-600" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta obra?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-4 text-lg font-medium text-gray-600">Nenhuma obra encontrada</p>
                                        <p class="mt-1 text-gray-500">Cadastre sua primeira obra clicando no botão "Nova Obra"</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($obras->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $obras->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
