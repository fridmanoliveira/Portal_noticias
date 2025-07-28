<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Novo Banner') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="titulo">Título</label>
                    <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="imagem">Imagem</label>
                    <input type="file" class="w-full border-gray-300 rounded-md shadow-sm" name="imagem" id="imagem" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="link">Link (opcional)</label>
                    <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" name="link" id="link" value="{{ old('link') }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="ordem">Ordem</label>
                    <input type="number" class="w-full border-gray-300 rounded-md shadow-sm" name="ordem" id="ordem" value="{{ old('ordem', 0) }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="carrossel">Carrossel?</label>
                    <input type="checkbox" class="text-sm text-gray-700" name="carrossel" id="carrossel" value="1" {{ old('carrossel') ? 'checked' : '' }}>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="ativo">Ativo?</label>
                    <input type="checkbox" class="text-sm text-gray-700" name="ativo" id="ativo" value="1" {{ old('ativo', true) ? 'checked' : '' }}>
                </div>

                <div>
                    <button type="submit">Salvar</button>
                    <a href="{{ route('admin.banners.index') }}">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
