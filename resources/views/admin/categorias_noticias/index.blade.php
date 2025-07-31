<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                Lista de Categorias de Notícias
            </h2>
            <a href="{{ route('admin.categorias-noticias.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Categoria
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 border border-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-md rounded-xl">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nome</th>
                            <th class="px-4 py-3">Ativo</th>
                            <th class="px-4 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($categorias as $categoria)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $categoria->id }}</td>
                                <td class="px-4 py-3 font-medium">{{ $categoria->nome }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                        {{ $categoria->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $categoria->ativo ? 'Sim' : 'Não' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.categorias-noticias.edit', $categoria->id) }}"
                                           class="text-indigo-600 hover:underline">Editar</a>
                                        <form action="{{ route('admin.categorias-noticias.destroy', $categoria->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta categoria? Isso também pode afetar notícias relacionadas!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    Nenhuma categoria encontrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
