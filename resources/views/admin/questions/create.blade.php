<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            {{ __('Criar Nova Questão') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">

                @if($errors->any())
                    <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.questions.store') }}">
                    @csrf

                    {{-- Título --}}
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Título *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipo --}}
                    <div class="mb-6">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-700">Tipo *</label>
                        <select id="type" name="type"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Selecione</option>
                            <option value="checkbox" @selected(old('type') == 'checkbox')>Checkbox</option>
                            <option value="radio" @selected(old('type') == 'radio')>Radio</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Opções Dinâmicas --}}
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Opções *</label>
                        <div id="options-container" class="space-y-2">
                            <div class="flex gap-2">
                                <input type="text" name="options[]" placeholder="Opção 1"
                                    class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600"
                                    onclick="removeOption(this)">X</button>
                            </div>
                        </div>
                        <button type="button" onclick="addOption()"
                            class="px-4 py-2 mt-3 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700">
                            + Adicionar opção
                        </button>
                        @error('options')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ações --}}
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.questions.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Salvar Questão
                        </button>
                    </div>
                </form>

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
                    <input type="text" name="options[]" placeholder="Opção ${index}"
                        class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600"
                        onclick="removeOption(this)">X</button>
                `;
                container.appendChild(div);
            }

            function removeOption(button) {
                const container = document.getElementById('options-container');
                if (container.children.length > 1) {
                    button.parentElement.remove();
                } else {
                    alert('A pergunta precisa ter pelo menos uma opção.');
                }
            }
        </script>
    @endpush
</x-app-layout>
