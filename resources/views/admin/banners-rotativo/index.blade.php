<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Banners Rotativos') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <a href="{{ route('admin.banners-rotativo.create') }}" class="text-blue-600 underline">Novo Banner</a>
            <table class="w-full mt-4 border border-collapse border-gray-300 table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">Imagem</th>
                        <th class="px-4 py-2 border">Título</th>
                        <th class="px-4 py-2 border">Link</th>
                        <th class="px-4 py-2 border">Ordem</th>
                        <th class="px-4 py-2 border">Ativo</th>
                        <th class="px-4 py-2 border">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td class="px-4 py-2 border">
                            <img src="{{ asset('storage/' . $banner->imagem) }}" width="100">
                        </td>
                        <td class="px-4 py-2 border">{{ $banner->titulo }}</td>
                        <td class="px-4 py-2 border">{{ $banner->link }}</td>
                        <td class="px-4 py-2 border">{{ $banner->ordem }}</td>
                        <td class="px-4 py-2 border">{{ $banner->ativo ? 'Sim' : 'Não' }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('admin.banners-rotativo.edit', $banner->id) }}" class="text-indigo-600 underline">Editar</a>
                            <form method="POST" action="{{ route('admin.banners-rotativo.destroy', $banner->id) }}" style="display:inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 text-red-600 underline">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
