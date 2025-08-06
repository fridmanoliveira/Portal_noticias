<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Editar Acesso Rápido') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form action="{{ route('admin.acessos-rapidos.update', $acesso->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $acesso->titulo) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>

                    <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="icone" class="block mb-1 text-sm font-semibold text-gray-700">Alterar Ícone (SVG ou imagem)</label>
                            <input type="file" name="icone" id="icone" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <p class="mb-2 text-sm text-gray-600">Prévia do ícone:</p>
                            <div class="flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-800 border border-gray-300 rounded-lg">
                                <img id="preview" src="{{ $acesso->icone ? url($acesso->icone) : '' }}"
                                    class="object-contain max-h-24" alt="Prévia do ícone">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="link" class="block mb-1 text-sm font-semibold text-gray-700">Link</label>
                        <input type="url" name="link" id="link" value="{{ old('link', $acesso->link) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>

                    <div>
                        <label for="ordem" class="block mb-1 text-sm font-semibold text-gray-700">Ordem de Exibição</label>
                        <input type="number" name="ordem" id="ordem" value="{{ old('ordem', $acesso->ordem) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('ativo', $acesso->ativo) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Ativo?</label>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.acessos-rapidos.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                            class="px-6 py-2 text-sm font-medium text-white transition-all bg-green-600 rounded-lg hover:bg-green-700">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('icone').addEventListener('change', function (event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
