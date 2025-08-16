<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Editar Ponto Turístico: ') . $turismo->titulo }}</h2>
                <p class="mt-1 text-sm text-gray-500">Atualize os detalhes deste ponto turístico</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.turismo.update', $turismo->id) }}" enctype="multipart/form-data" class="space-y-6">
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
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $turismo->titulo) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            @error('titulo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <div class="mt-1">
                                <textarea name="descricao" id="descricao" rows="10"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">{{ old('descricao', $turismo->descricao) }}</textarea>
                            </div>
                            @error('descricao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo PDF -->
                        <div>
                            <label for="pdf" class="block text-sm font-medium text-gray-700">PDF do Inventário Turístico</label>
                            <div class="flex items-center mt-1">
                                <label for="pdf" class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Clique para enviar</span> ou arraste o arquivo
                                        </p>
                                        <p class="text-xs text-gray-500">PDF (MAX. 10MB)</p>
                                    </div>
                                    <input id="pdf" name="pdf" type="file" accept="application/pdf" class="hidden" />
                                </label>
                            </div>
                            @if($turismo->pdf)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">PDF atual:</p>
                                    <a href="{{ asset($turismo->pdf) }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                                        Visualizar PDF
                                    </a>
                                    <label class="flex items-center mt-1 text-sm text-red-600">
                                        <input type="checkbox" name="remover_pdf" value="1" class="mr-2">
                                        Remover PDF atual
                                    </label>
                                </div>
                            @endif
                            @error('pdf')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox Ativo -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="ativo" name="ativo" type="checkbox" value="1" @checked(old('ativo', $turismo->ativo))
                                    class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="ativo" class="font-medium text-gray-700">Ponto turístico ativo</label>
                                <p class="text-xs text-gray-500">Desmarque para ocultar este ponto turístico</p>
                            </div>
                        </div>

                        <!-- Adicionar novas imagens -->
                        <div>
                            <label for="imagens" class="block text-sm font-medium text-gray-700">Adicionar novas imagens</label>
                            <div class="flex items-center mt-1">
                                <label for="imagens" class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Clique para enviar</span> ou arraste os arquivos
                                        </p>
                                        <p class="text-xs text-gray-500">Imagens (MAX. 5MB cada)</p>
                                    </div>
                                    <input id="imagens" name="imagens[]" type="file" multiple accept="image/*" class="hidden" />
                                </label>
                            </div>
                            @error('imagens.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Galeria existente -->
                        @if($turismo->imagens->count())
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Imagens atuais</label>
                                <div class="grid grid-cols-2 gap-4 mt-1 sm:grid-cols-3">
                                    @foreach($turismo->imagens as $imagem)
                                        <div class="relative overflow-hidden border border-gray-200 rounded-lg group">
                                            <img src="{{ asset($imagem->image_path) }}" alt="Imagem do turismo" class="object-cover w-full h-40">
                                            <div class="absolute inset-0 flex items-center justify-center transition-opacity bg-black bg-opacity-50 opacity-0 group-hover:opacity-100">
                                                <a href="{{ asset($imagem->image_path) }}" target="_blank" class="p-2 text-white bg-blue-500 rounded-full hover:bg-blue-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                            <label class="absolute bottom-0 left-0 right-0 p-2 text-sm text-center bg-white bg-opacity-90">
                                                <input type="checkbox" name="remover_imagens[]" value="{{ $imagem->id }}" class="mr-1">
                                                <span class="text-red-600">Remover</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.turismo.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Atualizar Ponto Turístico
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#descricao'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link',
                        'bulletedList', 'numberedList', 'blockQuote',
                        'alignment',
                        'undo', 'redo'
                    ],
                    alignment: {
                        options: [ 'justify', 'left', 'right', 'center' ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>
