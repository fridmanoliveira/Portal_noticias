<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Editar Categoria de Notícia: ') . $categoria->nome }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form action="{{ route('admin.categorias-noticias.update', $categoria->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nome da Categoria -->
                    <div>
                        <label for="nome" class="block mb-1 text-sm font-semibold text-gray-700">Nome da Categoria</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $categoria->nome) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('nome') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ativo -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('ativo', $categoria->ativo) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Categoria Ativa?</label>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.categorias-noticias.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                            Atualizar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
