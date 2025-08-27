<x-site-layout title="Mapa do Site">
    <div class="px-4 py-8 mx-auto max-w-7xl sm:container">
        <!-- Header -->
        <header class="mb-12 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 mb-6 rounded-full bg-gradient-to-r from-[#004348] to-[#0e7c86]">
                <i class="text-2xl text-white fas fa-sitemap"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 md:text-5xl">
                Mapa do Site
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
                Explore todas as páginas do nosso portal de forma organizada e intuitiva.
            </p>
        </header>

        <!-- Search Box -->
        <div class="max-w-2xl mx-auto mb-12">
            <label for="searchInput" class="sr-only">Buscar no Mapa do Site</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                    <i class="text-gray-400 fas fa-search"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Buscar páginas..."
                    class="block w-full py-4 pl-12 pr-5 text-lg text-gray-900 placeholder-gray-500 border border-gray-200 rounded-xl focus:outline-none focus:ring-3 focus:ring-[#004348] focus:border-[#004348] shadow-sm transition-all">
            </div>
            <p class="mt-3 text-sm text-center text-gray-500">Digite o nome de uma página para filtrar rapidamente</p>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden max-w-md px-6 py-12 mx-auto text-center bg-white shadow-sm rounded-xl">
            <i class="block mb-4 text-5xl text-gray-300 fas fa-search"></i>
            <h3 class="text-xl font-semibold text-gray-600">Nenhum resultado encontrado</h3>
            <p class="mt-2 text-gray-500">Tente usar termos diferentes ou verifique a ortografia.</p>
        </div>

        <!-- Sitemap Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 sitemap-grid">
            <!-- Páginas Principais -->
            <div class="p-6 transition-all bg-white border border-gray-100 shadow-sm rounded-xl card-hover">
                <div class="flex items-center mb-5">
                    <div class="flex items-center justify-center w-12 h-12 text-white bg-[#004348] rounded-xl">
                        <i class="text-xl fas fa-globe"></i>
                    </div>
                    <h2 class="ml-4 text-xl font-semibold text-gray-900">Páginas Principais</h2>
                </div>
                <ul class="space-y-3 sitemap-links">
                    <li>
                        <a href="/"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-home"></i>
                            </span>
                            <span class="font-medium">Início</span>
                        </a>
                    </li>
                    <li>
                        <a href="/historia-da-cidade"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-landmark"></i>
                            </span>
                            <span class="font-medium">História da Cidade</span>
                        </a>
                    </li>
                    <li>
                        <a href="/turismos"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-map-marked-alt"></i>
                            </span>
                            <span class="font-medium">Turismo</span>
                        </a>
                    </li>
                    <li>
                        <a href="/noticias"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-newspaper"></i>
                            </span>
                            <span class="font-medium">Notícias</span>
                        </a>
                    </li>
                    <li>
                        <a href="/obras-andamento"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-hard-hat"></i>
                            </span>
                            <span class="font-medium">Obras</span>
                        </a>
                    </li>
                    <li>
                        <a href="/ppa-participativo"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-clipboard-list"></i>
                            </span>
                            <span class="font-medium">PPA Participativo</span>
                        </a>
                    </li>
                    <li>
                        <a href="/politicas-privacidade"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#0e7c86] rounded-lg group-hover:bg-[#004348] transition-colors">
                                <i class="text-xs fas fa-shield-alt"></i>
                            </span>
                            <span class="font-medium">Políticas de Privacidade</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Notícias -->
            <div class="p-6 transition-all bg-white border border-gray-100 shadow-sm rounded-xl card-hover">
                <div class="flex items-center mb-5">
                    <div class="flex items-center justify-center w-12 h-12 text-white bg-[#d13c33] rounded-xl">
                        <i class="text-xl fas fa-newspaper"></i>
                    </div>
                    <h2 class="ml-4 text-xl font-semibold text-gray-900">Notícias</h2>
                </div>
                <ul class="space-y-3 sitemap-links">
                    <li>
                        <a href="/noticias"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#d13c33] rounded-lg group-hover:bg-[#b03028] transition-colors">
                                <i class="text-xs fas fa-list"></i>
                            </span>
                            <span class="font-medium">Todas as Notícias</span>
                        </a>
                    </li>

                    <!-- Lista de Notícias Recentes -->
                    <li class="pt-4 mt-4 border-t border-gray-100">
                        <label for="noticias-toggle"
                            class="flex items-center justify-between p-3 font-medium text-gray-700 transition-colors rounded-lg cursor-pointer hover:bg-gray-50 group">
                            <div class="flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 mr-3 text-[#d13c33] bg-gray-100 rounded-lg group-hover:bg-gray-200 transition-colors">
                                    <i class="text-xs fas fa-clock"></i>
                                </span>
                                <span>Notícias Recentes</span>
                            </div>
                            <i class="text-[#d13c33] fas fa-chevron-down transition-transform"
                                id="noticias-chevron"></i>
                        </label>
                        <input type="checkbox" id="noticias-toggle" class="hidden collapse-toggle">
                        <div class="collapse-content">
                            <ul class="pl-4 mt-3 space-y-2 border-l-2 border-gray-200">
                                <?php foreach($noticias as $noticia): ?>
                                <li class="py-2">
                                    <a href="<?= route('site.noticias.show', $noticia) ?>"
                                        class="flex text-gray-600 hover:text-[#d13c33] transition-colors">
                                        <i class="w-4 h-4 mt-1 mr-2 text-gray-400 fas fa-arrow-right"></i>
                                        <span class="truncate"><?= e($noticia->titulo) ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Obras Públicas -->
            <div class="p-6 transition-all bg-white border border-gray-100 shadow-sm rounded-xl card-hover">
                <div class="flex items-center mb-5">
                    <div class="flex items-center justify-center w-12 h-12 text-white bg-[#f97316] rounded-xl">
                        <i class="text-xl fas fa-wrench"></i>
                    </div>
                    <h2 class="ml-4 text-xl font-semibold text-gray-900">Obras Públicas</h2>
                </div>
                <ul class="space-y-3 sitemap-links">
                    <li>
                        <a href="/obras-andamento"
                            class="flex items-center p-3 text-gray-700 transition-colors rounded-lg hover:bg-gray-50 group">
                            <span
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-[#f97316] rounded-lg group-hover:bg-[#ea580c] transition-colors">
                                <i class="text-xs fas fa-tools"></i>
                            </span>
                            <span class="font-medium">Obras em Andamento</span>
                        </a>
                    </li>

                    <!-- Lista de Obras Recentes -->
                    <li class="pt-4 mt-4 border-t border-gray-100">
                        <label for="obras-toggle"
                            class="flex items-center justify-between p-3 font-medium text-gray-700 transition-colors rounded-lg cursor-pointer hover:bg-gray-50 group">
                            <div class="flex items-center">
                                <span
                                    class="flex items-center justify-center w-8 h-8 mr-3 text-[#f97316] bg-gray-100 rounded-lg group-hover:bg-gray-200 transition-colors">
                                    <i class="text-xs fas fa-hard-hat"></i>
                                </span>
                                <span>Obras em Destaque</span>
                            </div>
                            <i class="text-[#f97316] fas fa-chevron-down transition-transform" id="obras-chevron"></i>
                        </label>
                        <input type="checkbox" id="obras-toggle" class="hidden collapse-toggle">
                        <div class="collapse-content">
                            <ul class="pl-4 mt-3 space-y-2 border-l-2 border-gray-200">
                                <?php foreach($obras as $obra): ?>
                                <li class="py-2">
                                    <a href="<?= route('obras.show', $obra) ?>"
                                        class="flex text-gray-600 hover:text-[#f97316] transition-colors">
                                        <i class="w-4 h-4 mt-1 mr-2 text-gray-400 fas fa-arrow-right"></i>
                                        <span class="truncate"><?= e($obra->descricao) ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const noResults = document.getElementById('noResults');
            const sitemapSections = document.querySelectorAll('.sitemap-grid > section');
            const allLinks = document.querySelectorAll('.sitemap-links a');

            // Toggle de colapsar/expandir
            document.querySelectorAll('[data-toggle]').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const target = document.getElementById(toggle.dataset.toggle);
                    const chevron = toggle.querySelector('.chevron');
                    target.classList.toggle('hidden');
                    toggle.setAttribute('aria-expanded', target.classList.contains('hidden') ?
                        'false' : 'true');
                    chevron.style.transform = target.classList.contains('hidden') ? 'rotate(0)' :
                        'rotate(180deg)';
                });
            });

            // Destaque de busca
            function highlightText(node, term) {
                const text = node.textContent;
                const regex = new RegExp(`(${term})`, 'gi');
                node.innerHTML = text.replace(regex, `<span class="search-highlight">$1</span>`);
            }

            function clearHighlights() {
                allLinks.forEach(link => {
                    const span = link.querySelector('span:last-child');
                    if (span) span.textContent = span.textContent; // reset
                });
            }

            // Filtro da busca
            searchInput.addEventListener('input', () => {
                const term = searchInput.value.toLowerCase().trim();
                let foundAny = false;
                clearHighlights();

                sitemapSections.forEach(section => {
                    let sectionFound = false;
                    const links = section.querySelectorAll('.sitemap-links li');

                    links.forEach(li => {
                        const text = li.textContent.toLowerCase();
                        if (text.includes(term)) {
                            li.style.display = '';
                            highlightText(li.querySelector('span:last-child'), term);
                            sectionFound = true;
                            foundAny = true;
                        } else {
                            li.style.display = 'none';
                        }
                    });

                    section.style.display = sectionFound ? '' : 'none';
                });

                noResults.classList.toggle('hidden', foundAny);
            });
        });
    </script>
    <style>
        :root {
            --primary-color: #004348;
            --secondary-color: #0e7c86;
            --accent-color: #f97316;
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .search-highlight {
            background-color: #fffbeb;
            color: var(--primary-color);
            font-weight: 600;
            padding: 0 2px;
            border-radius: 3px;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .collapse-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .collapse-toggle:checked ~ .collapse-content {
            max-height: 1000px;
        }
    </style>
</x-site-layout>
