<x-site-layout :title="$obra->descricao">
    <section class="px-4 py-10 mx-auto font-sans sm:container">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Conteúdo principal -->
            <div class="lg:col-span-2">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="flex flex-col justify-between mb-6 space-y-4 md:items-center md:flex-row md:space-y-0">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $obra->descricao }}</h1>
                        <span class="px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded-full">
                            {{ $obra->situacao }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2">
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Fonte de Recurso</h3>
                            <p class="text-lg font-semibold">{{ $obra->fonte_recurso }}</p>
                        </div>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Valor Total</h3>
                            <p class="text-lg font-semibold">{{ $obra->valor_formatado }}</p>
                        </div>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Data de Início</h3>
                            <p class="text-lg font-semibold">{{ $obra->data_inicio_formatada }}</p>
                        </div>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Previsão de Término</h3>
                            <p class="text-lg font-semibold">{{ $obra->data_conclusao_formatada }}</p>
                        </div>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Prazos Aditados:</h3>
                            <p class="text-lg font-semibold">
                                {{ $obra->prazo_aditado ? $obra->prazo_aditado : 'SEM ADITIVOS ATÉ O MOMENTO' }}
                            </p>
                        </div>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Valores Aditados:</h3>
                            <p class="text-lg font-semibold">
                                {{ empty($obra->valor_aditado) || $obra->valor_aditado == 0.00 ? 'SEM ADITIVOS ATÉ O MOMENTO' : $obra->valor_aditado }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="mb-3 text-lg font-semibold text-gray-800">Progresso da Obra</h3>
                        <div class="flex items-center">
                            <div class="w-full mr-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="h-2.5 rounded-full
                                        @if($obra->etapa_atual == 100) bg-green-600
                                        @elseif($obra->etapa_atual > 70) bg-blue-600
                                        @elseif($obra->etapa_atual > 30) bg-yellow-500
                                        @else bg-red-500
                                        @endif"
                                        style="width: {{ $obra->etapa_atual }}%">
                                    </div>
                                </div>
                            </div>
                            <span class="text-lg font-bold">{{ $obra->etapa_atual }}%</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="mb-3 text-lg font-semibold text-gray-800">Empresa Responsável</h3>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <p class="font-semibold">{{ $obra->empresa->nome }}</p>
                            <p class="text-sm text-gray-600">
                                CNPJ:
                                {{ $obra->empresa->cnpj
                                    ? preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $obra->empresa->cnpj)
                                    : 'Não informado' }}
                            </p>
                            <p class="text-sm text-gray-600">CNPJ: {{ $obra->empresa->responsavel_legal }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="mb-3 text-lg font-semibold text-gray-800">Fiscal Técnico</h3>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <p class="font-semibold">{{ $obra->fiscal->nome ?? 'Não designado' }}</p>
                            @if($obra->fiscal)
                            <p class="text-sm text-gray-600">CREA: {{ $obra->fiscal->crea }}</p>
                            <p class="text-sm text-gray-600">
                                CPF:
                                {{ $obra->fiscal->cpf
                                    ? preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $obra->fiscal->cpf)
                                    : 'Não informado' }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Galeria de Fotos -->
                <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Galeria de Fotos</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($galeria as $foto)
                        <a href="{{ $foto['url'] }}" data-lightbox="obra-gallery" data-title="{{ $foto['legenda'] }}">
                            <img src="{{ $foto['url'] }}" alt="{{ $foto['legenda'] }}" class="object-cover w-full h-32 rounded-lg">
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Localização -->
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Localização</h3>
                    <div class="overflow-hidden rounded-lg h-60">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.093055709833!2d-44.071543!3d-7.409391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x789e0b1f2e1a3d3%3A0x2a9d821a719d263a!2sCristino%20Castro%2C%20PI!5e0!3m2!1spt-BR!2sbr!4v1722421389924!5m2!1spt-BR!2sbr"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-site-layout>
