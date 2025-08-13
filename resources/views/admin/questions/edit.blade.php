<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Editar Questão: {{ $question->title }}</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <form action="{{ route('admin.questions.update', $question) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Título --}}
                    <x-input-label for="title" value="Título" />
                    <x-text-input id="title" name="title" value="{{ old('title', $question->title) }}" required />

                    {{-- Tipo --}}
                    <x-input-label for="type" value="Tipo" class="mt-4" />
                    <select id="type" name="type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="checkbox" @selected(old('type', $question->type) == 'checkbox')>Checkbox</option>
                        <option value="radio" @selected(old('type', $question->type) == 'radio')>Radio</option>
                    </select>

                    {{-- Opções Dinâmicas --}}
                    <div class="mt-4">
                        <x-input-label value="Opções" />
                        <div id="options-container" class="space-y-2">
                            @foreach(old('options', $question->options->pluck('option_text')->toArray()) as $index => $opt)
                                <div class="flex gap-2">
                                    <input type="text" name="options[]" value="{{ $opt }}" placeholder="Opção {{ $index + 1 }}" class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">X</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addOption()" class="px-4 py-2 mt-3 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700">+ Adicionar opção</button>
                    </div>

                    {{-- Ações --}}
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.questions.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">Atualizar Questão</button>
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
                    <input type="text" name="options[]" placeholder="Opção ${index}" class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">X</button>
                `;
                container.appendChild(div);
            }

            function removeOption(button) {
                const container = document.getElementById('options-container');
                if(container.children.length > 1) button.parentElement.remove();
                else alert('A pergunta precisa ter pelo menos uma opção.');
            }
        </script>
    @endpush
</x-app-layout>
