<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Editar Obra: ') . $obra->descricao }}</h2>
                <p class="mt-1 text-sm text-gray-500">Atualize os detalhes desta obra</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.obras.update', $obra->slug) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
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

                        <!-- Campo Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="descricao" id="descricao" value="{{ old('descricao', $obra->descricao) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            @error('descricao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Fonte de Recurso -->
                        <div>
                            <label for="fonte_recurso" class="block text-sm font-medium text-gray-700">Fonte de Recurso</label>
                            <div class="mt-1">
                                <input type="text" name="fonte_recurso" id="fonte_recurso" value="{{ old('fonte_recurso', $obra->fonte_recurso) }}"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            @error('fonte_recurso')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Empresa -->
                        <div>
                            <label for="empresa_id" class="block text-sm font-medium text-gray-700">Empresa <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select name="empresa_id" id="empresa_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                    <option value="">Selecione a Empresa</option>
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id }}" @selected(old('empresa_id', $obra->empresa_id) == $empresa->id)>
                                            {{ $empresa->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('empresa_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Fiscal -->
                        <div>
                            <label for="fiscal_id" class="block text-sm font-medium text-gray-700">Fiscal <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select name="fiscal_id" id="fiscal_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                    <option value="">Selecione o Fiscal</option>
                                    @foreach($fiscais as $fiscal)
                                        <option value="{{ $fiscal->id }}" @selected(old('fiscal_id', $obra->fiscal_id) == $fiscal->id)>
                                            {{ $fiscal->nome }} (CREA: {{ $fiscal->crea }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('fiscal_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grupo Datas -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Data Início -->
                            <div>
                                <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data Início <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="date"
                                        name="data_inicio"
                                        id="data_inicio"
                                        value="{{ old('data_inicio', $obra->data_inicio ? \Carbon\Carbon::parse($obra->data_inicio)->format('Y-m-d') : '') }}"
                                        required
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('data_inicio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Data Conclusão -->
                            <div>
                                <label for="data_conclusao" class="block text-sm font-medium text-gray-700">Data Conclusão</label>
                                <div class="mt-1">
                                    <input type="date"
                                        name="data_conclusao"F
                                        id="data_conclusao"
                                        value="{{ old('data_conclusao', $obra->data_conclusao ? \Carbon\Carbon::parse($obra->data_conclusao)->format('Y-m-d') : '') }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('data_conclusao')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Situação -->
                        <div>
                            <label for="situacao" class="block text-sm font-medium text-gray-700">Situação <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select name="situacao" id="situacao" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                    <option value="">Selecione a Situação</option>
                                    <option value="Em planejamento" @selected(old('situacao', $obra->situacao) == 'Em planejamento')>Em planejamento</option>
                                    <option value="Em andamento" @selected(old('situacao', $obra->situacao) == 'Em andamento')>Em andamento</option>
                                    <option value="Concluída" @selected(old('situacao', $obra->situacao) == 'Concluída')>Concluída</option>
                                    <option value="Paralisada" @selected(old('situacao', $obra->situacao) == 'Paralisada')>Paralisada</option>
                                    <option value="Cancelada" @selected(old('situacao', $obra->situacao) == 'Cancelada')>Cancelada</option>
                                </select>
                            </div>
                            @error('situacao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Valor -->
                        <div>
                            <label for="valor" class="block text-sm font-medium text-gray-700">Valor (R$) <span class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500">R$</span>
                                </div>
                                <input type="number" step="0.01" name="valor" id="valor" value="{{ old('valor', $obra->valor) }}" required
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            @error('valor')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- PRAZOS E VALORES ADITADOS --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Valor Aditado -->
                            <div>
                                <label for="valor_aditado" class="block text-sm font-medium text-gray-700">
                                    Valor Aditado
                                </label>
                                <div class="mt-1">
                                    <input type="number" name="valor_aditado" id="valor_aditado"
                                        value="{{ old('valor_aditado', $obra->valor_aditado) }}"
                                        min="0" step="0.01"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm
                                                focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('valor_aditado')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prazo Aditado -->
                            <div>
                                <label for="prazo_aditado" class="block text-sm font-medium text-gray-700">
                                    Prazo Aditado (dias)
                                </label>
                                <div class="mt-1">
                                    <input type="number" name="prazo_aditado" id="prazo_aditado"
                                        value="{{ old('prazo_aditado', $obra->prazo_aditado) }}"
                                        min="0"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm
                                                focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('prazo_aditado')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- LATITUDE E LOGITUDE --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Latitude -->
                            <div>
                                <label for="latitude" class="block text-sm font-medium text-gray-700">
                                    Latitude
                                </label>
                                <div class="mt-1">
                                    <input type="number" name="latitude" id="latitude"
                                        value="{{ old('latitude', $obra->latitude) }}"
                                        step="0.0000001" min="-90" max="90"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm
                                            focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('latitude')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- longitude -->
                            <div>
                                <label for="longitude" class="block text-sm font-medium text-gray-700">
                                    Longitude
                                </label>
                                <div class="mt-1">
                                    <input type="number" name="longitude" id="longitude"
                                        value="{{ old('longitude', $obra->longitude) }}"
                                        step="0.0000001" min="-180" max="180"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm
                                            focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('longitude')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Galeria de Imagens - Versão melhorada -->
                        <div>
                            <label for="imagens" class="block text-sm font-medium text-gray-700">Galeria de Imagens</label>
                            <div class="mt-1">
                                <div x-data="{ files: [] }" class="space-y-4">
                                    <!-- Área de Upload -->
                                    <label for="imagens"
                                           class="flex flex-col items-center justify-center w-full px-4 py-6 transition duration-150 ease-in-out border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50"
                                           @dragover.prevent="document.getElementById('imagens').classList.add('border-[#0596A2]')"
                                           @dragleave.prevent="document.getElementById('imagens').classList.remove('border-[#0596A2]')"
                                           @drop.prevent="document.getElementById('imagens').classList.remove('border-[#0596A2]');
                                                          const newFiles = Array.from($event.dataTransfer.files);
                                                          if (newFiles.some(file => !file.type.match('image.*'))) {
                                                              alert('Apenas arquivos de imagem são permitidos');
                                                              return;
                                                          }
                                                          files.push(...newFiles);
                                                          document.getElementById('imagens').files = $event.dataTransfer.files;">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500">
                                                <span class="font-semibold">Clique para enviar</span> ou arraste as imagens
                                            </p>
                                            <p class="text-xs text-gray-500">Formatos: JPG, PNG (MAX. 5MB cada)</p>
                                        </div>
                                        <input id="imagens" name="imagens[]" type="file" multiple accept="image/jpeg, image/png" class="hidden"
                                               @change="files = Array.from($event.target.files)">
                                    </label>

                                    <!-- Preview das imagens selecionadas -->
                                    <template x-if="files.length > 0">
                                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                                            <template x-for="(file, index) in files" :key="index">
                                                <div class="relative group">
                                                    <div class="overflow-hidden rounded-lg aspect-w-1 aspect-h-1">
                                                        <img :src="file.type.match('image.*') ? URL.createObjectURL(file) : ''"
                                                             class="object-cover w-full h-full"
                                                             :alt="'Pré-visualização ' + (index + 1)">
                                                    </div>
                                                    <button type="button"
                                                            @click="files.splice(index, 1);
                                                                    const dataTransfer = new DataTransfer();
                                                                    files.forEach(f => dataTransfer.items.add(f));
                                                                    document.getElementById('imagens').files = dataTransfer.files;"
                                                            class="absolute top-0 right-0 p-1 text-white bg-red-500 rounded-full opacity-0 group-hover:opacity-100">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="mt-1 text-xs text-gray-500 truncate" x-text="file.name"></div>
                                                    <div class="text-xs text-gray-400" x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>

                                    <!-- Mensagem quando não há imagens -->
                                    <template x-if="files.length === 0">
                                        <p class="text-sm text-gray-500">Nenhuma imagem selecionada</p>
                                    </template>
                                </div>
                            </div>
                            @error('imagens.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Galeria existente -->
                        @if($obra->imagens->count())
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Imagens atuais</label>
                                <div class="grid grid-cols-2 gap-4 mt-1 sm:grid-cols-3">
                                    @foreach($obra->imagens as $imagem)
                                        <div class="relative overflow-hidden border border-gray-200 rounded-lg group">
                                            <img src="{{ asset($imagem->image_path) }}" alt="Imagem do obra" class="object-cover w-full h-40">
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
                            <a href="{{ route('admin.obras.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Atualizar Obra
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        @push('scripts')
        <script>
            // Validação do formulário antes de enviar
            document.getElementById('obraForm').addEventListener('submit', function(e) {
                const imagensInput = document.getElementById('imagens');
                if (imagensInput.files.length > 0) {
                    for (let i = 0; i < imagensInput.files.length; i++) {
                        const file = imagensInput.files[i];
                        // Verifica o tipo do arquivo
                        if (!file.type.match('image.*')) {
                            alert('Apenas arquivos de imagem são permitidos');
                            e.preventDefault();
                            return;
                        }
                        // Verifica o tamanho do arquivo (5MB)
                        if (file.size > 5 * 1024 * 1024) {
                            alert('O arquivo ' + file.name + ' excede o limite de 5MB');
                            e.preventDefault();
                            return;
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
