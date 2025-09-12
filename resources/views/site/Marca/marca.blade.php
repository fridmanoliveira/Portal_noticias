<x-site-layout title="Manual da Marca - Prefeitura de Cristino Castro">

    <div class="max-w-4xl mx-auto px-4 py-16 sm:py-24">

        {{-- 1. Seção de Apresentação --}}
        <section class="text-center pb-16 border-b">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">Manual da Marca</h1>
            <p class="text-lg text-gray-600">
                Este guia estabelece as diretrizes para a correta aplicação da identidade visual da Prefeitura de Cristino Castro, garantindo consistência e reconhecimento.
            </p>
        </section>

        {{-- 2. Seção do Brasão e seus significados --}}
        <section class="py-16 border-b">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">O Brasão</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center">
                    <img src="{{ asset('manual/logo-vertical.png') }}" alt="Detalhes do Brasão" class="rounded-lg shadow-lg w-80">
                </div>
                <div class="text-gray-700 space-y-4">
                    <p>O brasão de Cristino Castro é composto por elementos que representam a história, a economia e a cultura da nossa cidade:</p>
                    <ul class="list-disc list-inside space-y-3">
                        <li><strong>Coroa Murada:</strong> Com cinco torres, representa o status de cidade.</li>
                        <li><strong>Cristino de Ribeiro Castro:</strong> Homenageia o primeiro industrial estabelecido na região.</li>
                        <li><strong>Poços Jorrantes:</strong> Simboliza uma das nossas maiores riquezas naturais.</li>
                        <li><strong>Rio Gurgueia:</strong> Representa a força que impulsiona nossa atividade agrícola.</li>
                        <li><strong>Ramos de Algodão:</strong> Elementos decorativos que indicam a relevância da produção de algodão.</li>
                        <li><strong>Listel:</strong> Contém o nome do município e sua data de fundação, 29 de outubro de 1953.</li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- 3. Seção da Paleta de Cores --}}
        <section class="py-16 border-b">
            <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Paleta de Cores</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-full h-32 rounded-lg shadow-md mb-3" style="background-color: #006A4E;"></div>
                    <h3 class="font-bold text-lg">Verde Institucional</h3>
                    <p class="text-sm text-gray-500">HEX: #006A4E</p>
                    <p class="text-sm text-gray-500">CMYK: 80, 30, 75, 20</p>
                </div>
                <div class="text-center">
                    <div class="w-full h-32 rounded-lg shadow-md mb-3 border" style="background-color: #FFFFFF;"></div>
                    <h3 class="font-bold text-lg">Branco</h3>
                    <p class="text-sm text-gray-500">HEX: #FFFFFF</p>
                </div>
                <div class="text-center">
                    <div class="w-full h-32 rounded-lg shadow-md mb-3" style="background-color: #4B5563;"></div>
                    <h3 class="font-bold text-lg">Cinza Escuro</h3>
                    <p class="text-sm text-gray-500">HEX: #4B5563</p>
                </div>
                <div class="text-center">
                    <div class="w-full h-32 rounded-lg shadow-md mb-3" style="background-color: #F3F4F6;"></div>
                    <h3 class="font-bold text-lg">Cinza Claro</h3>
                    <p class="text-sm text-gray-500">HEX: #F3F4F6</p>
                </div>
            </div>
        </section>

        {{-- 4. Seção de Tipografia --}}
        <section class="py-16 border-b">
            <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Tipografia</h2>
            <div class="text-center text-gray-700">
                <p class="mb-8">A identidade visual utiliza uma família tipográfica sem serifa, de estilo moderno e com boa legibilidade. Recomenda-se o uso da família <span class="font-bold">Montserrat</span> ou similar para garantir consistência.</p>
                <div class="bg-gray-100 p-8 rounded-lg">
                    <h3 class="text-6xl font-bold">Aa</h3>
                    <p class="text-2xl font-light mt-4">ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                    <p class="text-2xl font-light">abcdefghijklmnopqrstuvwxyz</p>
                    <p class="text-2xl font-medium mt-2">0123456789</p>
                </div>
            </div>
        </section>

        {{-- 5. Seção de Aplicações da Marca --}}
        <section class="py-16 border-b">
            <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Aplicações da Marca</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="border rounded-lg p-6 flex flex-col items-center justify-center bg-gray-50 h-56">
                    <img src="{{ asset('manual/logo-horizontal.png') }}" alt="Assinatura Horizontal" class="max-h-24 mb-4">
                    <h4 class="font-semibold mt-auto pt-4">Assinatura Horizontal</h4>
                </div>
                <div class="border rounded-lg p-6 flex flex-col items-center justify-center bg-gray-50 h-56">
                    <img src="{{ asset('manual/logo-vertical.png') }}" alt="Assinatura Vertical" class="max-h-24 mb-4">
                    <h4 class="font-semibold mt-auto pt-4">Assinatura Vertical</h4>
                </div>
                <div class="border rounded-lg p-6 flex flex-col items-center justify-center bg-gray-50 h-56">
                    <img src="{{ asset('manual/logo-horizontal-mono.png') }}" alt="Assinatura Monocromática" class="max-h-24 mb-4">
                    <h4 class="font-semibold mt-auto pt-4">Assinatura Monocromática</h4>
                </div>
            </div>
        </section>

        {{-- 6. Seção de Downloads --}}
        <section class="pt-16">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Downloads</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Faça o download dos arquivos da marca em diferentes formatos para sua aplicação.</p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ asset('anexos/LOGO CRISTINO 2025.rar') }}" download class="bg-[#006A4E] text-white font-bold py-3 px-6 rounded-lg hover:bg-opacity-90 transition-colors">
                        Pacote Completo (.rar)
                    </a>
                    <a href="{{ asset('manual/brasao.png') }}" download class="bg-gray-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-700 transition-colors">
                        Brasão (.png)
                    </a>
                    <a href=" {{ asset('manual/logo-horizontal.png') }}" download class="bg-gray-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-700 transition-colors">
                        Assinatura Horizontal (.png)
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-site-layout>
