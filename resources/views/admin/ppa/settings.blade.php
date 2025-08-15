<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Configurações do PPA Participativo</h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 border border-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 bg-white rounded-lg shadow">
                <form action="{{ route('admin.ppa.fechado.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $settings->id }}">

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título do Formulário</label>
                            <input type="text" name="title" id="title"
                                value="{{ old('title', $settings->title) }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrição do Formulário</label>
                            <textarea name="description" id="description" rows="3"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $settings->description) }}</textarea>
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                            <input type="date" name="start_date" id="start_date"
                                   value="{{ old('start_date', $settings->start_date ? $settings->start_date->format('Y-m-d') : '') }}"
                                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Término</label>
                            <input type="date" name="end_date" id="end_date"
                                   value="{{ old('end_date', $settings->end_date ? $settings->end_date->format('Y-m-d') : '') }}"
                                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active"
                                value="1"
                                {{ old('is_active', $settings->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="is_active">Formulário ativo</label>
                        </div>

                        <div class="md:col-span-2">
                            <label for="closed_message" class="block text-sm font-medium text-gray-700">Mensagem quando fechado</label>
                            <textarea name="closed_message" id="closed_message" rows="3"
                                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('closed_message', $settings->closed_message) }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Esta mensagem será exibida quando o formulário estiver fechado.</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Salvar Configurações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
