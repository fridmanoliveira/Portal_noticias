<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                Banners Rotativos
            </h2>
            <a href="{{ route('admin.banners-rotativo.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition bg-green-600 rounded-md hover:bg-green-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Novo Banner
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md rounded-xl">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">Imagem</th>
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Link</th>
                            <th class="px-4 py-3">Ordem</th>
                            <th class="px-4 py-3">Ativo</th>
                            <th class="px-4 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($banners as $banner)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <img src="{{ asset($banner->imagem) }}"
                                         alt="Imagem do banner {{ $banner->titulo }}"
                                         class="object-contain rounded-sm max-h-12">
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $banner->titulo }}</td>
                                <td class="px-4 py-3 text-blue-600 underline">{{ $banner->link }}</td>
                                <td class="px-4 py-3">{{ $banner->ordem }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                        {{ $banner->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $banner->ativo ? 'Sim' : 'Não' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.banners-rotativo.edit', $banner->id) }}"
                                           class="text-indigo-600 hover:underline">Editar</a>
                                        <form action="{{ route('admin.banners-rotativo.destroy', $banner->id) }}"
                                              method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    Nenhum banner encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
