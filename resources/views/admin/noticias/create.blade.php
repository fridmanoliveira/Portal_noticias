<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Criar Nova Notícia') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <!-- Formulário com tratamento de erros -->
                <form id="noticiaForm" method="POST" action="{{ route('admin.noticias.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Mensagens de erro globais -->
                    @if($errors->any())
                        <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Título -->
                    <div class="mb-6">
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-700">Título *</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('titulo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resumo -->
                    <div class="mb-6">
                        <label for="resumo" class="block mb-2 text-sm font-medium text-gray-700">Resumo *</label>
                        <textarea name="resumo" id="resumo" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>{{ old('resumo') }}</textarea>
                        @error('resumo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Imagem e Prévia -->
                    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="imagem" class="block mb-2 text-sm font-medium text-gray-700">Imagem *</label>
                            <input type="file" name="imagem" id="imagem" accept="image/*"
                                class="block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            <p class="mt-1 text-xs text-gray-500">Formatos: JPEG, PNG (Max: 20MB)</p>
                            @error('imagem')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Prévia da Imagem</label>
                            <div class="flex items-center justify-center w-full h-40 p-4 border-2 border-gray-300 border-dashed rounded-lg">
                                <img id="preview" class="hidden max-h-full" alt="Prévia da imagem"/>
                                <span id="noPreview" class="text-gray-500">Nenhuma imagem selecionada</span>
                            </div>
                        </div>
                    </div>

                    <!-- Data de Publicação -->
                    <div class="mb-6">
                        <label for="publicado_em" class="block mb-2 text-sm font-medium text-gray-700">Data de Publicação *</label>
                        <input type="datetime-local" name="publicado_em" id="publicado_em"
                            value="{{ old('publicado_em', now()->format('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('publicado_em')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Conteúdo -->
                    <div class="mb-6">
                        <label for="conteudo" class="block mb-2 text-sm font-medium text-gray-700">Conteúdo *</label>
                        <textarea name="conteudo" id="conteudo" rows="10"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>{{ old('conteudo') }}</textarea>
                        @error('conteudo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoria -->
                    <div class="mb-6">
                        <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-700">Categoria *</label>
                        <select name="categoria_id" id="categoria_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="flex items-center mb-6 space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            @checked(old('ativo', true))>
                        <label for="ativo" class="text-sm font-medium text-gray-700">Notícia Ativa</label>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.noticias.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Salvar Notícia
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @push('scripts')
        <script>
            // Preview de imagem
            document.getElementById('imagem').addEventListener('change', function(e) {
                const preview = document.getElementById('preview');
                const noPreview = document.getElementById('noPreview');
                const file = e.target.files[0];

                if (file && file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        noPreview.classList.add('hidden');
                    }

                    reader.readAsDataURL(file);
                } else {
                    preview.classList.add('hidden');
                    noPreview.classList.remove('hidden');
                }
            });

            // Validação antes do submit
            document.getElementById('noticiaForm').addEventListener('submit', function(e) {
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Por favor, preencha todos os campos obrigatórios.');
                }
            });

            // Inicialização do editor (opcional)
            ClassicEditor
            .create(document.querySelector('#conteudo'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo',  ]
            })
            .catch(error => {
                console.error(error);
            });
            // ClassicEditor.create(document.querySelector('#conteudo')).catch(console.error);
        </script>
    @endpush
</x-app-layout>
