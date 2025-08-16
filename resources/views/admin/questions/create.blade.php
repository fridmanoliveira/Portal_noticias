<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Criar Nova Questão</h2>
                <p class="mt-1 text-sm text-gray-500">Adicione uma nova questão ao formulário</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.questions.store') }}" class="space-y-6">
                        @csrf

                        <!-- Campo Título -->
                        <div>
                            <x-input-label for="title" value="Título *" />
                            <x-text-input id="title" name="title" value="{{ old('title') }}" required
                                class="w-full mt-1" />
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo Tipo -->
                        <div>
                            <x-input-label for="type" value="Tipo *" />
                            <select id="type" name="type" required
                                class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                                <option value="">Selecione o tipo</option>
                                <option value="checkbox" @selected(old('type') == 'checkbox')>Múltipla escolha (Checkbox)</option>
                                <option value="radio" @selected(old('type') == 'radio')>Escolha única (Radio)</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Opções Dinâmicas -->
                        <div>
                            <x-input-label value="Opções *" />
                            <div id="options-container" class="mt-1 space-y-2">
                                <div class="flex gap-2">
                                    <x-text-input name="options[]" placeholder="Opção 1" required
                                        class="flex-1" />
                                    <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600"
                                        onclick="removeOption(this)" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="button" onclick="addOption()"
                                class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-white bg-[#0596A2] rounded-lg hover:bg-[#047a85]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Adicionar opção
                            </button>
                            @error('options')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('options.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.questions.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Salvar Questão
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function addOption() {
                const container = document.getElementById('options-container');
                const index = container.children.length + 1;
                const div = document.createElement('div');
                div.classList.add('flex', 'gap-2');
                div.innerHTML = `
                    <x-text-input name="options[]" placeholder="Opção ${index}" required class="flex-1" />
                    <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600" onclick="removeOption(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                `;
                container.appendChild(div);

                // Habilita o botão de remover da primeira opção se houver mais de uma
                if(container.children.length > 1) {
                    container.firstElementChild.querySelector('button').disabled = false;
                }
            }

            function removeOption(button) {
                const container = document.getElementById('options-container');
                if(container.children.length > 1) {
                    button.parentElement.remove();

                    // Desabilita o botão de remover se só restar uma opção
                    if(container.children.length === 1) {
                        container.firstElementChild.querySelector('button').disabled = true;
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
