<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Criar Nova Notícia') }}</h2>
                <p class="mt-1 text-sm text-gray-500">Adicione uma nova notícia ao sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="noticiaForm" method="POST" action="{{ route('admin.noticias.store') }}" enctype="multipart/form-data" class="space-y-6">
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

                        <!-- Campo Título -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
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
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">{{ old('resumo') }}</textarea>
                            </div>
                            @error('resumo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grupo Imagem Principal -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="imagem" class="block text-sm font-medium text-gray-700">Imagem de Capa <span class="text-red-500">*</span></label>
                                <div class="flex items-center mt-1">
                                    <label for="imagem" class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clique para enviar</span> ou arraste</p>
                                            <p class="text-xs text-gray-500">JPEG, PNG, WEBP (MAX. 5MB)</p>
                                        </div>
                                        <input id="imagem" name="imagem" type="file" accept="image/*" class="hidden" required />
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pré-visualização da Capa</label>
                                <div class="flex flex-col items-center justify-center mt-1">
                                    <div class="w-full h-40 p-4 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                                        <img id="preview" class="hidden object-contain w-full h-full" alt="Pré-visualização" />
                                        <span id="noPreview" class="text-gray-500">Nenhuma imagem selecionada</span>
                                    </div>
                                    <p id="file-name" class="mt-2 text-xs text-gray-500">Nenhum arquivo selecionado</p>
                                </div>
                            </div>
                        </div>

                        <!-- Campo Data -->
                        <div>
                            <label for="publicado_em" class="block text-sm font-medium text-gray-700">Data de Publicação <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="datetime-local" name="publicado_em" id="publicado_em"
                                    value="{{ old('publicado_em', now()->format('Y-m-d\TH:i')) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                        </div>

                        <!-- Conteúdo -->
                        <div>
                            <label for="conteudo" class="block text-sm font-medium text-gray-700">Conteúdo da Notícia <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <textarea name="conteudo" id="conteudo">{{ old('conteudo') }}</textarea>
                            </div>
                            @error('conteudo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select name="categoria_id" id="categoria_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Ativo -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="ativo" name="ativo" type="checkbox" value="1" @checked(old('ativo', true))
                                    class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="ativo" class="font-medium text-gray-700">Notícia ativa</label>
                            </div>
                        </div>

                        <!-- Ações -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.noticias.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] rounded-lg hover:bg-[#047a85]">
                                Salvar Notícia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .ck-editor__editable_inline { min-height: 400px; }
            .ck-content { text-align: justify; }
            .ck.ck-editor__main>.ck-editor__editable { background: #fff !important; border-radius: 0 0 0.5rem 0.5rem !important; border-color: #D1D5DB !important; }
            .ck.ck-editor__top .ck-sticky-panel .ck-toolbar { border-radius: 0.5rem 0.5rem 0 0 !important; background: #F9FAFB !important; border-color: #D1D5DB !important; }
            .ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable) { border-color: #0596A2 !important; box-shadow: 0 0 0 2px rgba(5, 150, 162, 0.2) !important; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
        <script>
            // Adaptador customizado para garantir o upload correto
            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return {
                        upload() {
                            return loader.file.then(file => new Promise((resolve, reject) => {
                                const data = new FormData();
                                data.append('upload', file);
                                fetch("{{ route('admin.noticias.upload.image') }}", {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: data
                                })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.url) resolve({ default: result.url });
                                    else reject(result.error ? result.error.message : 'Erro no upload');
                                })
                                .catch(err => reject('Erro na conexão com o servidor'));
                            }));
                        },
                        abort() {}
                    };
                };
            }

            document.addEventListener("DOMContentLoaded", function() {
                const textarea = document.querySelector('#conteudo');
                if (!textarea) return;

                const factory = (typeof CKEDITOR !== 'undefined') ? CKEDITOR.ClassicEditor : (typeof ClassicEditor !== 'undefined' ? ClassicEditor : null);

                if (factory) {
                    factory.create(textarea, {
                        extraPlugins: [MyCustomUploadAdapterPlugin],
                        toolbar: {
                            items: [
                                'heading', '|', 'bold', 'italic', 'strikethrough', 'underline', '|',
                                'alignment', '|', 'bulletedList', 'numberedList', 'todoList', '|',
                                'outdent', 'indent', '|', 'undo', 'redo', '|',
                                'fontSize', 'fontColor', '|', 'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                'horizontalLine'
                            ],
                            shouldNotGroupWhenFull: true
                        },
                        alignment: { options: ['left', 'center', 'right', 'justify'] },
                        placeholder: 'Digite o conteúdo da notícia aqui...',
                    }).then(editor => { window.editor = editor; })
                    .catch(error => { console.error('Erro:', error); });
                }
            });

            // Preview Capa
            document.getElementById('imagem').addEventListener('change', function(e) {
                const preview = document.getElementById('preview');
                const noPreview = document.getElementById('noPreview');
                const fileName = document.getElementById('file-name');
                const file = e.target.files[0];
                if (file && file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        noPreview.classList.add('hidden');
                        fileName.textContent = file.name;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Submit
            document.getElementById('noticiaForm').addEventListener('submit', function(e) {
                if (window.editor) {
                    const content = window.editor.getData();
                    if (!content.trim()) { e.preventDefault(); alert('O campo conteúdo é obrigatório.'); }
                }
            });
        </script>
    @endpush
</x-app-layout>