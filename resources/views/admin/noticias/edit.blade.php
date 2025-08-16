<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Editar Notícia: ') . $noticia->titulo }}</h2>
                <p class="mt-1 text-sm text-gray-500">Atualize os detalhes desta notícia</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.noticias.update', $noticia->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

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

                        <!-- Campo Título -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $noticia->titulo) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            @error('titulo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Resumo -->
                        <div>
                            <label for="resumo" class="block text-sm font-medium text-gray-700">Resumo <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <textarea name="resumo" id="resumo" rows="3" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">{{ old('resumo', $noticia->resumo) }}</textarea>
                            </div>
                            @error('resumo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grupo Imagem -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Upload Imagem -->
                            <div>
                                <label for="imagem" class="block text-sm font-medium text-gray-700">Nova Imagem</label>
                                <div class="flex items-center mt-1">
                                    <label for="imagem" class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500">
                                                <span class="font-semibold">Clique para enviar</span> ou arraste o arquivo
                                            </p>
                                            <p class="text-xs text-gray-500">JPEG, PNG (MAX. 20MB)</p>
                                        </div>
                                        <input id="imagem" name="imagem" type="file" accept="image/*" class="hidden" />
                                    </label>
                                </div>
                                @error('imagem')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                @if($noticia->imagem)
                                    <div class="flex items-center mt-3">
                                        <input type="checkbox" name="remover_imagem" id="remover_imagem" value="1"
                                            class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                                        <label for="remover_imagem" class="block ml-2 text-sm text-gray-700">Remover imagem atual?</label>
                                    </div>
                                @endif
                            </div>

                            <!-- Pré-visualização da Imagem -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pré-visualização</label>
                                <div class="flex flex-col items-center justify-center mt-1">
                                    @if($noticia->imagem)
                                        <div class="w-full h-40 p-4 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                                            <img id="preview" src="{{ url($noticia->imagem) }}" class="object-contain w-full h-full" alt="Imagem atual da notícia">
                                        </div>
                                        <p id="file-name" class="mt-2 text-xs text-gray-500">Imagem atual</p>
                                    @else
                                        <div class="w-full h-40 p-4 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                                            <img id="preview" class="hidden object-contain w-full h-full" alt="Pré-visualização da imagem">
                                            <span id="noPreview" class="text-gray-500">Nenhuma imagem atual</span>
                                        </div>
                                        <p id="file-name" class="mt-2 text-xs text-gray-500">Nenhum arquivo selecionado</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Campo Data de Publicação -->
                        <div>
                            <label for="publicado_em" class="block text-sm font-medium text-gray-700">Data de Publicação <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="datetime-local" name="publicado_em" id="publicado_em"
                                    value="{{ old('publicado_em', $noticia->publicado_em ? $noticia->publicado_em->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                            @error('publicado_em')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Conteúdo -->
                        <div>
                            <label for="conteudo" class="block text-sm font-medium text-gray-700">Conteúdo <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <textarea name="conteudo" id="conteudo" rows="10" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">{{ old('conteudo', $noticia->conteudo) }}</textarea>
                            </div>
                            @error('conteudo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Categoria -->
                        <div>
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select name="categoria_id" id="categoria_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @selected(old('categoria_id', $noticia->categoria_id) == $categoria->id)>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categoria_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox Ativo -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="ativo" name="ativo" type="checkbox" value="1" @checked(old('ativo', $noticia->ativo))
                                    class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="ativo" class="font-medium text-gray-700">Notícia ativa</label>
                                <p class="text-xs text-gray-500">Desmarque para ocultar esta notícia</p>
                            </div>
                        </div>

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.noticias.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Atualizar Notícia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Preview de imagem
            document.getElementById('imagem').addEventListener('change', function(e) {
                const preview = document.getElementById('preview');
                const noPreview = document.getElementById('noPreview');
                const fileName = document.getElementById('file-name');
                const file = e.target.files[0];

                if (file && file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        if (noPreview) noPreview.classList.add('hidden');
                        fileName.textContent = file.name;
                    }

                    reader.readAsDataURL(file);
                } else {
                    preview.classList.add('hidden');
                    if (noPreview) noPreview.classList.remove('hidden');
                    fileName.textContent = 'Nenhum arquivo selecionado';
                }
            });

            // Inicialização do editor (opcional)
            ClassicEditor
                .create(document.querySelector('#conteudo'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>
