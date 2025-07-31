<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Editar Vídeo: ') . $video->titulo }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form method="POST" action="{{ route('admin.videos.update', $video->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo"
                               value="{{ old('titulo', $video->titulo) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('titulo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block mb-1 text-sm font-semibold text-gray-700">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="10"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('descricao', $video->descricao) }}</textarea>
                        @error('descricao') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Link do YouTube -->
                    <div>
                        <label for="link_youtube" class="block mb-1 text-sm font-semibold text-gray-700">Link do YouTube</label>
                        <input type="url" name="link_youtube" id="link_youtube"
                               value="{{ old('link_youtube', $video->link_youtube) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @error('link_youtube') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ativo -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" name="ativo" id="ativo" value="1"
                               class="text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                               {{ old('ativo', $video->ativo) ? 'checked' : '' }}>
                        <label for="ativo" class="text-sm text-gray-700">Vídeo Ativo?</label>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.videos.index') }}"
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
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>
