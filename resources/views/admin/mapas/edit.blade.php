<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Editar Página de Mapas') }}</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.mapas.update', $mapa->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $mapa->titulo) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                        </div>

                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <div class="mt-1">
                                <textarea name="descricao" id="descricao" rows="10"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">{{ old('descricao', $mapa->descricao) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label for="arquivo_pdf" class="block text-sm font-medium text-gray-700">Substituir Arquivo PDF (Opcional)</label>
                            <div class="mt-1">
                                 <input id="arquivo_pdf" name="arquivo_pdf" type="file" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>
                            @if($mapa->arquivo_pdf)
                                <p class="mt-2 text-sm text-gray-600">
                                    Arquivo atual: <a href="{{ asset($mapa->arquivo_pdf) }}" target="_blank" class="font-medium text-teal-600 hover:underline">Visualizar PDF</a>
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="texto_botao" class="block text-sm font-medium text-gray-700">Texto do Botão do PDF <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="texto_botao" id="texto_botao" value="{{ old('texto_botao', $mapa->texto_botao) }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="ativo" name="ativo" type="checkbox" value="1" @checked(old('ativo', $mapa->ativo))
                                    class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="ativo" class="font-medium text-gray-700">Página de Mapas Ativa</label>
                                <p class="text-xs text-gray-500">Marcar esta como a página de mapas principal do site. (A anterior será desativada).</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.mapas.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85]">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#descricao')).catch(error => console.error(error));
        </script>
    @endpush
</x-app-layout>
