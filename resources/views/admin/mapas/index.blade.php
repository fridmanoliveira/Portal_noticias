<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Página de Mapas</h2>
            <a href="{{ route('admin.mapas.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-teal-600 rounded-lg hover:bg-teal-700">
                Nova Página de Mapas
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Título</th>
                            <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($mapas as $mapa)
                            <tr>
                                <td class="px-6 py-4">{{ $mapa->titulo }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $mapa->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $mapa->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.mapas.edit', $mapa->id) }}" class="text-yellow-500 hover:text-yellow-700">Editar</a>
                                        <form method="POST" action="{{ route('admin.mapas.destroy', $mapa->id) }}" onsubmit="return confirm('Tem certeza?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-4 text-center text-gray-500">Nenhuma página de mapas cadastrada.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
