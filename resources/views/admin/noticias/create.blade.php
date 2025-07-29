<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Nova Notícia') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm sm:rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                <input type="text" name="titulo" id="titulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('titulo') border-red-500 @enderror" value="{{ old('titulo') }}" required>
                @error('titulo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="resumo" class="block text-gray-700 text-sm font-bold mb-2">Resumo:</label>
                <textarea name="resumo" id="resumo" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('resumo') border-red-500 @enderror" required>{{ old('resumo') }}</textarea>
                @error('resumo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="imagem" class="block text-gray-700 text-sm font-bold mb-2">Imagem:</label>
                <input type="file" name="imagem" id="imagem" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('imagem') border-red-500 @enderror" required>
                @error('imagem')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="publicado_em" class="block text-gray-700 text-sm font-bold mb-2">Data de Publicação:</label>
                <input type="datetime-local" name="publicado_em" id="publicado_em" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('publicado_em') border-red-500 @enderror" value="{{ old('publicado_em', date('Y-m-d\TH:i')) }}" required>
                @error('publicado_em')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="conteudo" class="block text-gray-700 text-sm font-bold mb-2">Conteúdo:</label>
                <textarea name="conteudo" id="conteudo" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('conteudo') border-red-500 @enderror" required>{{ old('conteudo') }}</textarea>
                @error('conteudo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="categoria_id" class="block text-gray-700 text-sm font-bold mb-2">Categoria:</label>
                <select name="categoria_id" id="categoria_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('categoria_id') border-red-500 @enderror" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="ativo" id="ativo" class="mr-2 leading-tight" {{ old('ativo', true) ? 'checked' : '' }}>
                <label for="ativo" class="text-sm text-gray-700">Notícia Ativa?</label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Salvar Notícia
                </button>
                <a href="{{ route('admin.noticias.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
