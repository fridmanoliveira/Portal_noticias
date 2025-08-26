<x-site-layout title="Página não encontrada">
<style type="text/css">
        .bg-pattern {
            background-color: #f0fdfa;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230d9488' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .map-container {
            filter: grayscale(0.2) contrast(1.1);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.2);
        }
    </style>
    <main class="flex-grow">
            <section class="bg-pattern flex flex-col items-center justify-center min-h-[70vh] py-16 text-center">
                <div class="max-w-2xl px-4 mx-auto sm:px-6 lg:px-8">
                    <div class="mb-6 animate-float">
                        <div class="inline-flex items-center justify-center bg-white border-8 border-teal-100 rounded-full shadow-lg w-28 h-28">
                            <i class="text-4xl text-teal-600 fas fa-exclamation-triangle"></i>
                        </div>
                    </div>

                    <h1 class="font-extrabold text-teal-600 text-8xl sm:text-9xl">404</h1>

                    <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                        Ops! Página não encontrada.
                    </h2>

                    <p class="mt-4 text-lg text-gray-600">
                        Lamentamos, mas a página que você está procurando pode ter sido removida, ter tido seu nome alterado ou está temporariamente indisponível.
                    </p>

                    <div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row">
                        <a href="{{ route('site.home') }}"
                           class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-teal-600 border border-transparent rounded-md shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <i class="mr-3 fas fa-home"></i>
                            Voltar para a página inicial
                        </a>

                       <a href="javascript:void(0);"
                        onclick="history.back();"
                        class="inline-flex items-center px-6 py-3 text-base font-medium text-teal-700 transition bg-teal-100 border border-transparent rounded-md hover:bg-teal-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-300">
                            <i class="mr-3 fas fa-arrow-left"></i>
                            Voltar à página anterior
                        </a>

                    </div>

                    <div class="mt-12 text-center">
                        <p class="mb-3 text-gray-500">Ou tente uma dessas páginas:</p>
                        <div class="flex flex-wrap justify-center gap-3">
                            <a href="{{ route('site.home') }}" class="px-4 py-2 text-sm text-teal-600 transition bg-white border border-teal-200 rounded-md hover:bg-teal-50">Home</a>
                            <a href="{{ route('site.home') . '#servicos' }}" class="px-4 py-2 text-sm text-teal-600 transition bg-white border border-teal-200 rounded-md hover:bg-teal-50">Serviços</a>
                            <a href="{{ route('site.turismo') }}" class="px-4 py-2 text-sm text-teal-600 transition bg-white border border-teal-200 rounded-md hover:bg-teal-50">Turismo</a>
                            <a href="{{ route('ppa.form') }}" class="px-4 py-2 text-sm text-teal-600 transition bg-white border border-teal-200 rounded-md hover:bg-teal-50">PPA Participativo</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-4 py-16 bg-white">
                <div class="max-w-5xl mx-auto">
                    <div class="mb-10 text-center">
                        <h2 class="mb-2 text-2xl font-bold text-gray-900">Nosso Local</h2>
                        <p class="text-gray-600">Visite nossa sede em Cristino Castro - PI</p>
                    </div>

                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.093055709833!2d-44.071543!3d-7.409391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x789e0b1f2e1a3d3%3A0x2a9d821a719d263a!2sCristino%20Castro%2C%20PI!5e0!3m2!1spt-BR!2sbr!4v1722421389924!5m2!1spt-BR!2sbr"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-10 md:grid-cols-3">
                        <div class="p-5 text-center rounded-lg bg-teal-50">
                            <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 text-teal-600 bg-teal-100 rounded-full">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="mb-1 font-semibold">Endereço</h3>
                            <p class="text-sm text-gray-600">Av. Marcos Parente, S/N, Centro Cristino Castro - PI, 64920-000</p>
                        </div>

                        <div class="p-5 text-center rounded-lg bg-teal-50">
                            <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 text-teal-600 bg-teal-100 rounded-full">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h3 class="mb-1 font-semibold">Telefone</h3>
                            <p class="text-sm text-gray-600">(89) 98106-0031</p>
                        </div>

                        <div class="p-5 text-center rounded-lg bg-teal-50">
                            <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 text-teal-600 bg-teal-100 rounded-full">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="mb-1 font-semibold">E-mail</h3>
                            <p class="text-sm text-gray-600">cristinocastroouvidoria@gmail.com</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script>
        // Adiciona uma animação de digitação para o título
        document.addEventListener('DOMContentLoaded', function() {
            const title = document.querySelector('title');
            let originalText = 'Página não encontrada';
            let i = 0;

            function typeWriter() {
                if (i < originalText.length) {
                    title.innerHTML += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            }

            title.innerHTML = '404 - ';
            typeWriter();
        });
    </script>

</x-site-layout>
