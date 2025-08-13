<x-site-layout title="PPA Participativo">
    <section class="px-4 py-10 mx-auto font-sans sm:container">
        <form action="{{ route('ppa.submit') }}" method="POST" class="max-w-3xl p-6 mx-auto space-y-8 bg-white shadow-lg rounded-xl">
            @csrf

            {{-- Título --}}
            <header class="text-center">
                <h1 class="mb-2 text-3xl font-bold text-gray-800">PPA Participativo</h1>
                <p class="text-gray-500">Preencha o formulário abaixo para registrar sua participação.</p>
            </header>

            {{-- Email --}}
            <div>
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="seuemail@exemplo.com"
                    required
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Perguntas --}}
            <div class="space-y-6">
                @foreach($questions as $question)
                    <div class="p-5 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                        <h2 class="mb-4 text-lg font-semibold text-gray-800">{{ $question->title }}</h2>

                        <div class="space-y-2">
                            @foreach($question->options as $option)
                                <label class="flex items-center gap-3 p-2 rounded cursor-pointer hover:bg-gray-100">
                                    <input
                                        type="{{ $question->type }}"
                                        name="answers[{{ $question->id }}]{{ $question->type === 'checkbox' ? '[]' : '' }}"
                                        value="{{ $option->id }}"
                                        class="text-blue-600 focus:ring-blue-500"
                                        @if(strtolower($option->option_text) === 'outro') data-outro="true" @endif
                                    >
                                    <span class="text-gray-700">{{ $option->option_text }}</span>
                                </label>

                                {{-- Campo extra se "Outro" --}}
                                @if(strtolower($option->option_text) === 'outro')
                                    <input
                                        type="text"
                                        name="other_answers[{{ $question->id }}]"
                                        class="hidden w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                        placeholder="Digite sua resposta"
                                    >
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Botão --}}
            <div class="text-center">
                <button
                    type="submit"
                    class="px-6 py-3 font-medium text-white transition-all duration-200 bg-blue-600 rounded-lg shadow hover:bg-blue-700"
                >
                    Enviar Respostas
                </button>
            </div>
        </form>
    </section>

    {{-- Script para mostrar/esconder campo "Outro" --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[data-outro="true"]').forEach(function(input) {
                input.addEventListener('change', function() {
                    const textInput = this.closest('label').nextElementSibling;
                    if (this.checked) {
                        textInput.classList.remove('hidden');
                    } else {
                        textInput.classList.add('hidden');
                        textInput.value = '';
                    }
                });
            });
        });
    </script>
</x-site-layout>
