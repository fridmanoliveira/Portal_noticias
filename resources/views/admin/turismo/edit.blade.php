<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Editar Vídeo: ') . $turismo->titulo }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form method="POST" action="{{ route('admin.turismo.update', $turismo->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo"
                               value="{{ old('titulo', $turismo->titulo) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('titulo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <!-- PDF -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">PDF do Inventário Turístico</label>
                        <input type="file" name="pdf" accept="application/pdf"
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm">

                        @if(!empty($turismo->pdf))
                            <p class="mt-2 text-sm text-blue-600">
                                <a href="{{ asset($turismo->pdf) }}" target="_blank">Ver PDF atual</a>
                            </p>
                        @endif
                        @error('pdf')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block mb-1 text-sm font-semibold text-gray-700">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="10"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('descricao', $turismo->descricao) }}</textarea>
                        @error('descricao') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ativo -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                            class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                            {{ old('ativo', $turismo->ativo) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Vídeo Ativo?</label>
                    </div>

                    <!-- Adicionar novas imagens -->
                    <div>
                        <label for="imagens" class="block mb-1 text-sm font-semibold text-gray-700">Adicionar novas imagens</label>
                        <input type="file" name="imagens[]" id="imagens" multiple accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('imagens.*') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Galeria existente -->
                    @if ($turismo->imagens->count())
                        <div class="mt-4">
                            <p class="mb-2 text-sm font-semibold text-gray-700">Imagens cadastradas:</p>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($turismo->imagens as $imagem)
                                    <div class="relative p-2 border rounded-lg group">
                                        <img src="{{ asset($imagem->image_path) }}" alt="Imagem"
                                             class="object-cover w-full h-40 mb-2 rounded-lg shadow-md">

                                        <!-- Checkbox para remover -->
                                        <label class="inline-flex items-center text-sm text-red-600">
                                            <input type="checkbox" name="remover_imagens[]" value="{{ $imagem->id }}" class="mr-2 text-red-600 border-gray-300 rounded">
                                            Remover esta imagem
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.turismo.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                                class="px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">Atualizar</button>
                    </div>
                </form>
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
