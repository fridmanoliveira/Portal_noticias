<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Criar Nova Obra') }}</h2>
                <p class="mt-1 text-sm text-gray-500">Cadastre uma nova obra no sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.obras.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                        <!-- Campo Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="descricao" id="descricao" value="{{ old('descricao') }}" required
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
                                <input type="text" name="fonte_recurso" id="fonte_recurso" value="{{ old('fonte_recurso') }}"
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
                                        <option value="{{ $empresa->id }}" @selected(old('empresa_id') == $empresa->id)>
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
                                        <option value="{{ $fiscal->id }}" @selected(old('fiscal_id') == $fiscal->id)>
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
                                    <input type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}" required
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
                                    <input type="date" name="data_conclusao" id="data_conclusao" value="{{ old('data_conclusao') }}"
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
                                    <option value="Em planejamento" @selected(old('situacao') == 'Em planejamento')>Em planejamento</option>
                                    <option value="Em andamento" @selected(old('situacao') == 'Em andamento')>Em andamento</option>
                                    <option value="Concluída" @selected(old('situacao') == 'Concluída')>Concluída</option>
                                    <option value="Paralisada" @selected(old('situacao') == 'Paralisada')>Paralisada</option>
                                    <option value="Cancelada" @selected(old('situacao') == 'Cancelada')>Cancelada</option>
                                </select>
                            </div>
                            @error('situacao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Etapa atual -->
                        <div>
                            <label for="valor" class="block text-sm font-medium text-gray-700">Etapa (%) <span class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500">%</span>
                                </div>
                                <input type="number" step="0.01" name="etapa_atual" id="etapa_atual" value="{{ old('etapa_atual') }}" required
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            @error('etapa_atual')
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
                                <input type="number" step="0.01" name="valor" id="valor" value="{{ old('valor') }}" required
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
                                        value="{{ old('valor_aditado') }}"
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
                                        value="{{ old('prazo_aditado') }}"
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
                                    <input type="text" name="latitude" id="latitude"
                                        value="{{ old('latitude') }}"
                                        min="0" step="0.01"
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
                                    <input type="text" name="longitude" id="longitude"
                                        value="{{ old('longitude') }}"
                                        min="0"
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

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.obras.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Salvar Obra
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
