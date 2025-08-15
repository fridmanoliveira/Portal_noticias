@php
    use App\Models\PpaSetting;
    // Garanta que $settings seja sempre definida, mesmo que não encontre nada no banco
    $settings = PpaSetting::first();
@endphp

<x-site-layout title="PPA Participativo - Prefeitura Municipal">
    <main class="py-8 bg-gray-50">
        <div class="container px-4 mx-auto">
            <div class="max-w-4xl mx-auto overflow-hidden bg-white shadow-lg rounded-xl">

                @if($settings && $settings->isCurrentlyActive())

                    <!-- Cabeçalho do Formulário -->
                    <div class="p-6 text-white bg-gradient-to-r from-blue-700 to-blue-600">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h1 class="text-2xl font-bold">{{ $settings->title }}</h1>
                                <p class="mt-1 opacity-90">Planejamento Plurianual Municipal</p>
                            </div>
                            <div class="px-4 py-2 mt-4 text-sm bg-blue-800 bg-opacity-50 rounded-lg md:mt-0">
                                <p class="mt-1 text-xs">Período: {{ $settings->start_date->format('d/m/Y') }} a {{ $settings->end_date->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Barra de Progresso -->
                    <div class="px-6 py-3 border-b border-blue-100 bg-blue-50">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-blue-800">Progresso do formulário</span>
                            <span id="progress-text" class="text-sm font-medium text-blue-600">0% completo</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div id="progress-bar" class="h-2 bg-blue-600 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Formulário -->
                    <form action="{{ route('ppa.submit') }}" method="POST" class="p-6 space-y-8 md:p-8">
                        @csrf

                        <!-- Introdução -->
                        <div class="p-5 border-l-4 border-blue-600 rounded-r-lg bg-blue-50">
                            <h2 class="text-xl font-bold text-gray-800">Sua participação é importante!</h2>
                            <p class="mt-2 text-gray-700">{{ $settings->description }}</p>
                            <p class="mt-3 text-sm text-gray-600">Tempo estimado para preenchimento: 8 minutos</p>
                        </div>

                        <!-- Seção de Identificação -->
                        <fieldset class="p-6 border border-gray-200 rounded-xl">
                            <legend class="flex items-center px-3 text-lg font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Identificação do participante
                            </legend>

                            <div class="grid gap-6 mt-4 sm:grid-cols-2">
                                <!-- Nome Completo -->
                                <div>
                                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700">
                                        Nome completo <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Digite seu nome completo" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CPF -->
                                <div>
                                    <label for="cpf" class="block mb-1 text-sm font-medium text-gray-700">
                                        CPF <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}"
                                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="000.000.000-00" required
                                        oninput="formatCPF(this)">
                                    @error('cpf')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </div>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="w-full gap-2 py-3 pl-10 pr-4 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="seuemail@exemplo.com" required>
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telefone -->
                                <div>
                                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">
                                        Telefone/WhatsApp <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="(99) 99999-9999" required
                                        oninput="formatPhone(this)">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bairro -->
                                <div>
                                    <label for="district" class="block mb-1 text-sm font-medium text-gray-700">
                                        Bairro <span class="text-red-500">*</span>
                                    </label>
                                    <select id="district" name="district"
                                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">Selecione seu bairro</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district }}" @if(old('district') == $district) selected @endif>{{ $district }}</option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Idade -->
                                <div>
                                    <label for="age_range" class="block mb-1 text-sm font-medium text-gray-700">
                                        Faixa etária <span class="text-red-500">*</span>
                                    </label>
                                    <select id="age_range" name="age_range"
                                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">Selecione sua faixa etária</option>
                                        <option value="16-20" @if(old('age_range') == '16-20') selected @endif>16 a 20 anos</option>
                                        <option value="21-30" @if(old('age_range') == '21-30') selected @endif>21 a 30 anos</option>
                                        <option value="31-40" @if(old('age_range') == '31-40') selected @endif>31 a 40 anos</option>
                                        <option value="41-50" @if(old('age_range') == '41-50') selected @endif>41 a 50 anos</option>
                                        <option value="51-60" @if(old('age_range') == '51-60') selected @endif>51 a 60 anos</option>
                                        <option value="61+" @if(old('age_range') == '61+') selected @endif>61 anos ou mais</option>
                                    </select>
                                    @error('age_range')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <!-- Seções de perguntas -->
                        @foreach($questionsBySection as $sectionName => $questions)
                            <div class="space-y-6">
                                @if($sectionName)
                                    <h3 class="pb-2 text-xl font-bold text-gray-800 border-b">{{ $sectionName }}</h3>
                                @endif

                                @foreach($questions as $question)
                                    <fieldset class="p-6 border border-gray-200 rounded-xl">
                                        <legend class="flex items-center px-2 text-lg font-semibold text-gray-700">
                                            <span class="inline-flex items-center justify-center w-8 h-8 mr-3 text-sm font-bold text-white bg-blue-600 rounded-full">
                                                {{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                            </span>
                                            {{ $question->title }}
                                            @if($question->description)
                                                <span class="ml-2 text-sm font-normal text-gray-500">{{ $question->description }}</span>
                                            @endif
                                        </legend>

                                        <div class="mt-4 space-y-4">
                                            @foreach($question->options as $option)
                                                <div class="flex items-start">
                                                    <div class="flex items-center h-5 mt-0.5">
                                                        <input
                                                            type="{{ $question->type }}"
                                                            name="answers[{{ $question->id }}]{{ $question->type === 'checkbox' ? '[]' : '' }}"
                                                            value="{{ $option->id }}"
                                                            id="option_{{ $option->id }}"
                                                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                            @if(in_array($option->id, (array) old("answers.$question->id", []))) checked @endif
                                                            @if(strtolower($option->option_text) === 'outro') data-outro="true" data-question="{{ $question->id }}" @endif
                                                        >
                                                    </div>
                                                    <label for="option_{{ $option->id }}" class="block ml-3 text-gray-700">
                                                        <span class="font-medium">{{ $option->option_text }}</span>
                                                        @if($option->description)
                                                            <p class="mt-1 text-sm text-gray-500">{{ $option->description }}</p>
                                                        @endif
                                                    </label>
                                                </div>

                                                <!-- Campo extra se "Outro" -->
                                                @if(strtolower($option->option_text) === 'outro')
                                                    <div id="other-field-{{ $question->id }}" class="{{ in_array($option->id, (array) old("answers.$question->id", [])) ? '' : 'hidden' }} mt-3 ml-7">
                                                        <input
                                                            type="text"
                                                            name="other_answers[{{ $question->id }}]"
                                                            value="{{ old("other_answers.$question->id") }}"
                                                            class="w-full px-4 py-2 text-sm transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                            placeholder="Por favor, especifique..."
                                                        >
                                                        @error("other_answers.$question->id")
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                @endif
                                            @endforeach
                                            @error("answers.$question->id")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                @endforeach
                            </div>
                        @endforeach

                        <!-- Sugestões Adicionais -->
                        <fieldset class="p-6 border border-gray-200 rounded-xl">
                            <legend class="flex items-center px-2 text-lg font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                Sugestões adicionais
                            </legend>
                            <div class="mt-4">
                                <label for="suggestions" class="block mb-1 text-sm font-medium text-gray-700">
                                    Tem alguma sugestão ou comentário adicional para o PPA Municipal?
                                </label>
                                <textarea id="suggestions" name="suggestions" rows="4"
                                    class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Escreva aqui suas sugestões...">{{ old('suggestions') }}</textarea>
                                @error('suggestions')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </fieldset>

                        <!-- Termos e Condições -->
                        <div class="p-6 border border-gray-200 rounded-xl bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex items-center h-5 mt-0.5">
                                    <input id="terms" name="terms" type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required
                                        @if(old('terms')) checked @endif>
                                </div>
                                <label for="terms" class="block ml-3 text-sm text-gray-700">
                                    Declaro que li e concordo com o <a href="#" class="font-medium text-blue-600 hover:underline">Termo de Consentimento</a> e autorizo o tratamento dos meus dados pessoais conforme a <a href="#" class="font-medium text-blue-600 hover:underline">Lei Geral de Proteção de Dados (LGPD, Lei nº 13.709/2018)</a>. Estou ciente de que minhas respostas serão utilizadas exclusivamente para fins de planejamento municipal e construção do PPA Participativo 2023-2026.
                                </label>
                            </div>
                            @error('terms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="flex flex-col mt-6 sm:flex-row sm:items-center sm:justify-between">
                                <div class="mb-4 sm:mb-0">
                                    <p class="text-xs text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Seus dados estão protegidos conforme a legislação vigente.
                                    </p>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white transition duration-200 bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    Enviar minha contribuição
                                </button>
                            </div>
                        </div>
                    @else
                    <div class="p-10 text-center">
                        <h2 class="text-2xl font-bold text-gray-800">Consulta encerrada</h2>
                        <p class="mt-4 text-gray-600">
                            {{ $settings && $settings->closed_message
                                ? $settings->closed_message
                                : 'O período para envio de contribuições foi encerrado. Agradecemos sua participação!' }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Mostrar/esconder campo "Outro"
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[data-outro="true"]').forEach(function(input) {
                const questionId = input.dataset.question;
                const otherField = document.getElementById(`other-field-${questionId}`);

                // Verificar estado inicial
                if (input.checked && otherField) {
                    otherField.classList.remove('hidden');
                }

                // Adicionar listener para mudanças
                input.addEventListener('change', function() {
                    if (this.checked && otherField) {
                        otherField.classList.remove('hidden');
                    } else if (otherField) {
                        otherField.classList.add('hidden');
                        otherField.querySelector('input').value = '';
                    }
                });
            });

            // Máscara para telefone
            function formatPhone(input) {
                let value = input.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);

                if (value.length > 0) {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    if (value.length > 10) {
                        value = value.replace(/(\d{5})(\d)/, '$1-$2');
                    } else {
                        value = value.replace(/(\d{4})(\d)/, '$1-$2');
                    }
                }

                input.value = value;
            }

            // Máscara para CPF
            function formatCPF(input) {
                let value = input.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);

                if (value.length > 0) {
                    value = value.replace(/^(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/\.(\d{3})(\d)/, '.$1-$2');
                }

                input.value = value;
            }

            // Ativar máscaras
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    formatPhone(e.target);
                });
                // Aplicar máscara ao carregar se já houver valor
                if (phoneInput.value) {
                    formatPhone(phoneInput);
                }
            }

            const cpfInput = document.getElementById('cpf');
            if (cpfInput) {
                cpfInput.addEventListener('input', function(e) {
                    formatCPF(e.target);
                });
                // Aplicar máscara ao carregar se já houver valor
                if (cpfInput.value) {
                    formatCPF(cpfInput);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const requiredFields = form.querySelectorAll('[required]');
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');

            function updateProgress() {
                let filled = 0;
                requiredFields.forEach(field => {
                    if ((field.type === 'checkbox' && field.checked) ||
                        (field.type !== 'checkbox' && field.value.trim() !== '')) {
                        filled++;
                    }
                });

                const percent = Math.round((filled / requiredFields.length) * 100);
                progressBar.style.width = percent + '%';
                progressText.textContent = percent + '% completo';
            }

            requiredFields.forEach(field => {
                field.addEventListener('input', updateProgress);
                field.addEventListener('change', updateProgress);
            });

            updateProgress(); // inicia
        });

    </script>
</x-site-layout>
