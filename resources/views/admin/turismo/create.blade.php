<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Cadastrar Novo Turismo') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form method="POST" action="{{ route('admin.turismo.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('titulo')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block mb-1 text-sm font-semibold text-gray-700">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="10"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">PDF do Inventário Turístico</label>
                        <input type="file" name="pdf" accept="application/pdf"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm">

                        @if(!empty($turismo->pdf))
                            <p class="mt-2 text-sm text-blue-600">
                                <a href="{{ asset($turismo->pdf) }}" target="_blank">Ver PDF atual</a>
                            </p>
                        @endif
                    </div>

                    <!-- Ativo -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('ativo', true) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Turismo Ativo?</label>
                    </div>

                    <!-- Galeria de Imagens -->
                    <div>
                        <label for="imagens" class="block mb-1 text-sm font-semibold text-gray-700">Galeria de Imagens</label>
                        <input type="file" name="imagens[]" id="imagens" multiple accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('imagens.*')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.turismo.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Salvar Turismo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#descricao'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>
