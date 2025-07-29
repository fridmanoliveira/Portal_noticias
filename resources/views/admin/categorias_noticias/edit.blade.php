<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoria de Notícia: ') . $categoria->nome }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <form action="{{ route('admin.categorias-noticias.update', $categoria->id) }}" method="POST" class="bg-white shadow-sm sm:rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome da Categoria:</label>
                <input type="text" name="nome" id="nome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nome') border-red-500 @enderror" value="{{ old('nome', $categoria->nome) }}" required>
                @error('nome')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="ativo" id="ativo" class="mr-2 leading-tight" {{ old('ativo', $categoria->ativo) ? 'checked' : '' }}>
                <label for="ativo" class="text-sm text-gray-700">Categoria Ativa?</label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Atualizar Categoria
                </button>
                <a href="{{ route('admin.categorias-noticias.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>