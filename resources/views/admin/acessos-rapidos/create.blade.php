<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Novo Acesso Rápido') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.acessos-rapidos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="titulo" id="titulo" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label for="icone" class="block text-sm font-medium text-gray-700">Ícone (upload SVG ou imagem)</label>
                    <input type="file" name="icone" id="icone" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                    <input type="url" name="link" id="link" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label for="ordem" class="block text-sm font-medium text-gray-700">Ordem</label>
                    <input type="number" name="ordem" id="ordem" value="0" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="ativo" id="ativo" value="1" class="mr-2" checked>
                    <label for="ativo" class="text-sm text-gray-700">Ativo?</label>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md">Salvar</button>
                    <a href="{{ route('admin.acessos-rapidos.index') }}" class="text-blue-600 underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
