<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Configurações do PPA Participativo</h2>
                <p class="mt-1 text-sm text-gray-500">Gerencie as configurações do formulário de participação</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <!-- Mensagem de sucesso -->
            @if(session('success'))
                <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-300 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.ppa.fechado.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $settings->id }}">

                        <!-- Grupo de Campos Principais -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Título do Formulário -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Título do Formulário <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="text" name="title" id="title" required
                                        value="{{ old('title', $settings->title) }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">
                                </div>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descrição do Formulário -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Descrição do Formulário</label>
                                <div class="mt-1">
                                    <textarea name="description" id="description" rows="3"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">{{ old('description', $settings->description) }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Datas -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="date" name="start_date" id="start_date" required
                                        value="{{ old('start_date', $settings->start_date ? $settings->start_date->format('Y-m-d') : '') }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Término <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="date" name="end_date" id="end_date" required
                                        value="{{ old('end_date', $settings->end_date ? $settings->end_date->format('Y-m-d') : '') }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                </div>
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Ativo -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_active" name="is_active" type="checkbox" value="1"
                                        {{ old('is_active', $settings->is_active) ? 'checked' : '' }}
                                        class="w-4 h-4 text-[#0596A2] border-gray-300 rounded focus:ring-[#0596A2]">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active" class="font-medium text-gray-700">Formulário ativo</label>
                                    <p class="text-xs text-gray-500">Marque para habilitar o formulário de participação</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mensagem quando fechado -->
                        <div>
                            <label for="closed_message" class="block text-sm font-medium text-gray-700">Mensagem quando fechado <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <textarea name="closed_message" id="closed_message" rows="3" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400">{{ old('closed_message', $settings->closed_message) }}</textarea>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Esta mensagem será exibida quando o formulário estiver fechado ou fora do período de participação.</p>
                            @error('closed_message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Salvar Configurações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Validação de datas
            document.querySelector('form').addEventListener('submit', function(e) {
                const startDate = new Date(document.getElementById('start_date').value);
                const endDate = new Date(document.getElementById('end_date').value);

                if (startDate && endDate && startDate > endDate) {
                    e.preventDefault();
                    alert('A data de início não pode ser posterior à data de término.');
                }
            });
        </script>
    @endpush
</x-app-layout>
