<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Criar Nova Notícia') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('titulo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Resumo -->
                    <div>
                        <label for="resumo" class="block mb-1 text-sm font-semibold text-gray-700">Resumo</label>
                        <textarea name="resumo" id="resumo" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>{{ old('resumo') }}</textarea>
                        @error('resumo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Imagem e Prévia -->
                    <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="imagem" class="block mb-1 text-sm font-semibold text-gray-700">Imagem</label>
                            <input type="file" name="imagem" id="imagem" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            @error('imagem') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <p class="mb-2 text-sm text-gray-600">Prévia da imagem:</p>
                            <div class="flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-100 border border-gray-300 rounded-lg">
                                <img id="preview" class="object-contain max-h-32" alt="Prévia da imagem" />
                            </div>
                        </div>
                    </div>

                    <!-- Publicado em -->
                    <div>
                        <label for="publicado_em" class="block mb-1 text-sm font-semibold text-gray-700">Data de Publicação</label>
                        <input type="datetime-local" name="publicado_em" id="publicado_em"
                            value="{{ old('publicado_em', date('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('publicado_em') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Conteúdo -->
                    <div>
                        <label for="conteudo" class="block mb-1 text-sm font-semibold text-gray-700">Conteúdo</label>
                        <textarea name="conteudo" id="conteudo" rows="10"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>{{ old('conteudo') }}</textarea>
                        @error('conteudo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="categoria_id" class="block mb-1 text-sm font-semibold text-gray-700">Categoria</label>
                        <select name="categoria_id" id="categoria_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ativo -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('ativo', true) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Notícia Ativa?</label>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.noticias.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                            class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Salvar Notícia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Script para pré-visualização -->
    <script>
        document.getElementById('imagem').addEventListener('change', function (event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        });

        ClassicEditor
            .create(document.querySelector('#conteudo'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo',  ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
