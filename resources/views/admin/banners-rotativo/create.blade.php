<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Novo Banner Rotativo') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form action="{{ route('admin.banners-rotativo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('titulo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Imagem + Prévia -->
                    <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="imagem" class="block mb-1 text-sm font-semibold text-gray-700">Imagem</label>
                            <input type="file" name="imagem" id="imagem" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            @error('imagem') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <p class="mb-2 text-sm text-gray-600">Prévia da imagem:</p>
                            <div class="flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-100 border border-gray-300 rounded-lg">
                                <img id="preview" class="object-contain max-h-32" alt="Prévia do banner" />
                            </div>
                        </div>
                    </div>

                    <!-- Link -->
                    <div>
                        <label for="link" class="block mb-1 text-sm font-semibold text-gray-700">Link (opcional)</label>
                        <input type="url" name="link" id="link" value="{{ old('link') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('link') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ordem -->
                    <div>
                        <label for="ordem" class="block mb-1 text-sm font-semibold text-gray-700">Ordem de Exibição</label>
                        <input type="number" name="ordem" id="ordem" value="{{ old('ordem', 0) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('ordem') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Carrossel -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="carrossel" id="carrossel" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('carrossel') ? 'checked' : '' }}>
                        <label for="carrossel" class="text-sm text-gray-700">Exibir no carrossel?</label>
                    </div>

                    <!-- Ativo -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('ativo', true) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Ativo?</label>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.banners-rotativo.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                            class="px-6 py-2 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para pré-visualização -->
    <script>
        document.getElementById('imagem').addEventListener('change', function (event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        });
    </script>
</x-app-layout>
