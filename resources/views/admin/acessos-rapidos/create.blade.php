<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Novo Acesso Rápido') }}</h2>
                <p class="mt-1 text-sm text-gray-500">Adicione um novo item de acesso rápido ao sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.acessos-rapidos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Campo Título -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="titulo" id="titulo" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Título que será exibido no item de acesso rápido</p>
                        </div>

                        <!-- Grupo Ícone -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Upload Ícone -->
                            <div>
                                <label for="icone" class="block text-sm font-medium text-gray-700">Ícone</label>
                                <div class="flex items-center mt-1">
                                    <label for="icone" class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500">
                                                <span class="font-semibold">Clique para enviar</span> ou arraste o arquivo
                                            </p>
                                            <p class="text-xs text-gray-500">SVG ou imagem (MAX. 2MB)</p>
                                        </div>
                                        <input id="icone" name="icone" type="file" accept="image/*" class="hidden" />
                                    </label>
                                </div>
                            </div>

                            <!-- Pré-visualização do Ícone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pré-visualização</label>
                                <div class="flex flex-col items-center justify-center mt-1">
                                    <div class="w-32 h-32 p-4 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                                        <img id="preview" class="object-contain w-full h-full" alt="Pré-visualização do ícone" />
                                    </div>
                                    <p id="file-name" class="mt-2 text-xs text-gray-500">Nenhum arquivo selecionado</p>
                                </div>
                            </div>
                        </div>

                        <!-- Campo Link -->
                        <div>
                            <label for="link" class="block text-sm font-medium text-gray-700">Link <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="url" name="link" id="link" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">URL completa incluindo https://</p>
                        </div>

                        <!-- Campo Ordem -->
                        <div>
                            <label for="ordem" class="block text-sm font-medium text-gray-700">Ordem de Exibição</label>
                            <div class="mt-1">
                                <input type="number" name="ordem" id="ordem" value="0"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Número que define a ordem de exibição (menor aparece primeiro)</p>
                        </div>

                        <!-- Checkbox Ativo -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="ativo" name="ativo" type="checkbox" value="1" checked
                                    class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="ativo" class="font-medium text-gray-700">Item ativo</label>
                                <p class="text-xs text-gray-500">Desmarque para ocultar este item</p>
                            </div>
                        </div>

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.acessos-rapidos.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Salvar Acesso Rápido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('icone').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            const fileName = document.getElementById('file-name');
            const file = event.target.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    fileName.textContent = file.name;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
                fileName.textContent = 'Nenhum arquivo selecionado';
            }
        });
    </script>
</x-app-layout>
