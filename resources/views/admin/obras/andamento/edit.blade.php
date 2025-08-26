<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Editar Andamento: ') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Atualize o andamento desta obra</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.andamento.update', $andamento->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

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
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">
                                Título <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="titulo" id="titulo"
                                value="{{ old('titulo', $andamento->titulo) }}"
                                required
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            @error('titulo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" rows="4"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">{{ old('descricao', $andamento->descricao) }}</textarea>
                            @error('descricao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Progresso -->
                        <div>
                            <label for="progresso" class="block text-sm font-medium text-gray-700">
                                Progresso (%) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="progresso" id="progresso" min="0" max="100" step="1"
                                value="{{ old('progresso', $andamento->progresso) }}"
                                required
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            @error('progresso')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data -->
                        <div>
                            <label for="data" class="block text-sm font-medium text-gray-700">
                                Data <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="data" id="data"
                                value="{{ old('data', $andamento->data ? \Carbon\Carbon::parse($andamento->data)->format('Y-m-d') : '') }}"
                                required
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            @error('data')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Anexo -->
                        <div>
                            <label for="anexo" class="block text-sm font-medium text-gray-700">Anexo</label>
                            <input type="file" name="anexo" id="anexo"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            @error('anexo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($andamento->anexo)
                                <p class="mt-2 text-sm text-gray-600">
                                    Arquivo atual: <a href="{{ asset('storage/' . $andamento->anexo) }}" target="_blank" class="text-blue-600 underline">Ver arquivo</a>
                                </p>
                            @endif
                        </div>

                        <!-- Obra -->
                        <div>
                            <input type="hidden" name="obra_id" value="{{ $obra->id }}">
                            <p class="font-medium text-gray-700">Obra: {{ $obra->descricao }}</p>
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.obras.andamentos.index', $obra->slug) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] rounded-lg shadow-sm hover:bg-[#047a85]">
                                Atualizar Andamento
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
