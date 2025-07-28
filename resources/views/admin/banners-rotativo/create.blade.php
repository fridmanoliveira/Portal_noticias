<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Novo Banner') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.banners-rotativo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Imagem</label>
                    <input type="file" name="imagem" class="block w-full mt-1">
                    @error('imagem') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Link</label>
                    <input type="text" name="link" value="{{ old('link') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @error('link') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Titulo</label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @error('titulo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                 <div>
                    <label class="block text-sm font-medium text-gray-700" for="ordem">Ordem</label>
                    <input type="number" class="w-full border-gray-300 rounded-md shadow-sm" name="ordem" id="ordem" value="{{ old('ordem', 0) }}">
                    @error('ordem') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                 <div>
                    <label class="block text-sm font-medium text-gray-700" for="ativo">Ativo?</label>
                    <input type="checkbox" class="text-sm text-gray-700" name="ativo" id="ativo" value="1" {{ old('ativo', true) ? 'checked' : '' }}>
                    @error('ativo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="carrossel" class="rounded" {{ old('carrossel') ? 'checked' : '' }}>
                        <span class="ml-2">Exibir no carrossel</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Salvar</button>
                    <a href="{{ route('admin.banners-rotativo.index') }}" class="ml-4 text-gray-600 underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
