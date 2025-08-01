@props(['title' => 'Prefeitura de Cristino Castro'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' - Prefeitura de Cristino Castro'}}</title>
    <!-- Otimização de fontes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome otimizado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AlpineJS otimizado -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" integrity="sha384-8Wq6eSRbHw7a9Nd1z2+0a1j0aPYdGkD1KkKRwD0J0QLiZqBk0Q1TUpj5D4FZL5O+" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Barra de utilidades com SVGs -->
    <div class="bg-[#004446] text-white text-xs py-1">
        <div class="px-3 mx-auto sm:container">
            <div class="flex flex-wrap items-center justify-between gap-2">
                <!-- Links e acessibilidade -->
                <div class="flex flex-wrap items-center gap-4 ">
                    <a href="#" class="font-bold hover:underline whitespace-nowrap">MAPA DO SITE</a>
                    <a href="#" class="font-semibold hover:underline whitespace-nowrap">WEBMAIL</a>
                    <div class="flex items-center gap-1">
                        <!-- Aumentar fonte -->
                        <button aria-label="Aumentar fonte" class="hover:text-green-300">
                            <img src="{{ asset('icons/resize-positivo.svg') }}" alt="">
                        </button>

                        <!-- Diminuir fonte -->
                        <button aria-label="Diminuir fonte" class="hover:text-green-300">
                            <img src="{{ asset('icons/resize-negativo.svg') }}" alt="">
                        </button>

                        <!-- Modo escuro -->
                        <button aria-label="Modo noturno" class="hover:text-green-300">
                            <img src="{{ asset('icons/contrast-circle.svg') }}" alt="">
                        </button>

                    </div>
                </div>

                <!-- Redes sociais com SVGs -->
                <div class="flex items-center gap-2">
                    <span class="hidden italic text-white/80 sm:inline whitespace-nowrap">Acompanhe:</span>
                    <div class="flex gap-1">
                        <a href="https://www.instagram.com/prefeituradecristinocastropi/" class="p-2 transition-colors rounded-full bg-white/10 hover:bg-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/prefeituracristinocastropi" class="p-2 transition-colors rounded-full bg-white/10 hover:bg-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="p-2 transition-colors rounded-full bg-white/10 hover:bg-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header otimizado para mobile -->
    <x-header
        class="sticky top-0 z-10 py-3 bg-white shadow-md"
    />

    <!-- Conteúdo principal -->
    <main class="flex-grow ">
        {{ $slot }}
    </main>

    <!-- Rodapé - Responsivo -->
    <footer class="bg-[#145156] text-white py-8 sm:py-12">
        <div class="container px-4 mx-auto max-w-7xl sm:container">
            <!-- Topo do rodapé - Versão com logo próxima à localização -->
            <div class="flex flex-col items-center gap-8 p-4 bg-[#004348] rounded-lg sm:gap-6 sm:p-6 md:flex-row md:justify-start md:items-start">
                <!-- Logo e contato lado a lado -->
                <div class="flex flex-col items-center gap-8 md:flex-row md:items-start md:gap-64">
                    <!-- Bloco de contato -->
                    <div class="space-y-2 text-center md:text-left">
                        <div class="flex items-start gap-2 sm:gap-3">
                            <svg class="w-4 h-4 mt-0.5 text-green-400 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="text-xs sm:text-sm">
                                Av. Marcos Parente, S/N, Centro<br>
                                Cristino Castro - PI, 64920-000
                            </p>
                        </div>
                        <div class="flex items-start gap-2 sm:gap-3">
                            <svg class="w-4 h-4 mt-0.5 text-green-400 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs sm:text-sm">Segunda a Sexta, 08:00 às 14:00</p>
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset('logo/logo.png') }}"
                            alt="Logo Prefeitura"
                            class="h-20 transition-transform hover:scale-105 sm:h-20">
                    </div>
                </div>

                <!-- Redes sociais -->
                <div class="text-center md:ml-auto">
                    <p class="mb-2 text-xs font-medium sm:text-sm">Acompanhe nossas redes</p>
                    <div class="flex justify-center gap-3 sm:gap-4">
                        <a href="https://www.facebook.com/prefeituracristinocastropi" class="p-1.5 transition-colors rounded-full bg-white/10 hover:bg-white/20 sm:p-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/prefeituradecristinocastropi/" class="p-1.5 transition-colors rounded-full bg-white/10 hover:bg-white/20 sm:p-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@PrefeituradeCristinoCastro" class="p-1.5 transition-colors rounded-full bg-white/10 hover:bg-white/20 sm:p-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 16.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Links de navegação -->
            <div class="grid grid-cols-1 gap-6 mt-8 sm:gap-10 sm:mt-12 md:grid-cols-3">
                <!-- Cidadão -->
                <div class="text-center md:text-left">
                    <h3 class="pb-1 mb-3 text-sm font-semibold tracking-wider uppercase border-b border-white/20 sm:text-lg sm:pb-2 sm:mb-4">Cidadão</h3>
                    <ul class="space-y-1 sm:space-y-2">
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Ouvidoria</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Carta de Serviços</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Portal da Transparência</a></li>
                    </ul>
                </div>

                <!-- Empresa -->
                <div class="text-center md:text-left md:border-x md:border-white/20 md:px-4 sm:px-6">
                    <h3 class="pb-1 mb-3 text-sm font-semibold tracking-wider uppercase border-b border-white/20 sm:text-lg sm:pb-2 sm:mb-4">Empresa</h3>
                    <ul class="space-y-1 sm:space-y-2">
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Alvará</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Licitações</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Certidões</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">ISS Online</a></li>
                    </ul>
                </div>

                <!-- Servidor -->
                <div class="text-center md:text-left">
                    <h3 class="pb-1 mb-3 text-sm font-semibold tracking-wider uppercase border-b border-white/20 sm:text-lg sm:pb-2 sm:mb-4">Servidor</h3>
                    <ul class="space-y-1 sm:space-y-2">
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Contracheque</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Portal do Servidor</a></li>
                        <li><a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Editais</a></li>
                    </ul>
                </div>
            </div>

            <!-- Rodapé inferior -->
            <div class="pt-6 mt-8 border-t border-white/10 sm:pt-8 sm:mt-12">
                <div class="flex flex-col items-center justify-between gap-3 sm:gap-4 md:flex-row">
                    <p class="text-xs text-white/80 sm:text-sm">&copy; 2023 Prefeitura Municipal. Todos os direitos reservados.</p>
                    <div class="flex flex-col items-center gap-2 sm:flex-row sm:gap-4">
                        <div class="text-xs text-white/60 sm:text-sm">
                            Desenvolvido por <a href="https://softsolucoes.tech/" target="_blank" class="transition-colors hover:text-green-300">SOFT SOLUÇÔES</a>
                        </div>
                        <div class="flex gap-3 sm:gap-4">
                            <a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Termos de Uso</a>
                            <a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Política de Privacidade</a>
                            <a href="#" class="text-xs transition-colors hover:text-green-300 sm:text-sm">Acessibilidade</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts otimizados -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('mobileMenuOpen', false);
        });
    </script>
    @stack('scripts')
</body>
</html>
