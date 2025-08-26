<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Registrar Andamento da Obra') }}</h2>
                <p class="mt-1 text-sm text-gray-500">Adicione um novo registro de andamento para a obra</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.obras.andamentos.store', $obra) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                            @error('titulo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <div class="mt-1">
                                <textarea name="descricao" id="descricao" rows="4"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">{{ old('descricao') }}</textarea>
                            </div>
                            @error('descricao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Progresso -->
                        <div>
                            <label for="progresso" class="block text-sm font-medium text-gray-700">Progresso (%) <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="number" name="progresso" id="progresso" value="{{ old('progresso') }}" required min="0" max="100"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                            @error('progresso')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Data -->
                        <div>
                            <label for="data" class="block text-sm font-medium text-gray-700">Data <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="date" name="data" id="data" value="{{ old('data') }}" required max="{{ date('Y-m-d') }}"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                            @error('data')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Anexo -->
                        <div>
                            <label for="anexo" class="block text-sm font-medium text-gray-700">Anexo (opcional)</label>
                            <div class="mt-1">
                                <input type="file" name="anexo" id="anexo" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                           file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                           file:bg-[#0596A2] file:text-white hover:file:bg-[#047a85]">
                            </div>
                            @error('anexo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="obra_id" value="{{ $obra->id }}">

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.obras.andamentos.index', $obra->slug) }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Salvar Andamento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
