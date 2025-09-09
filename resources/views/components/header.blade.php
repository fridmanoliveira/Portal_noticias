@props([
    'logo' => asset('logo/logo-header.png'),
    'alt' => 'Prefeitura de Cristino Castro',
    'links' => [
        ['route' => '/', 'text' => 'INÍCIO'],
        [
            'text' => 'MUNICÍPIO',
            'submenu' => [
                ['route' => '/historia-da-cidade', 'text' => 'História'],
                ['route' => '/turismos', 'text' => 'Turismo'],
            ],
        ],
        [
            'text' => 'A PREFEITURA',
            'submenu' => [
                ['route' => '/video-monitoramento', 'text' => 'Video Monitoramento'],
                ['route' => '/ppa-participativo', 'text' => 'PPA Participativo'],
                ['route' => '/manual-da-marca', 'text' => 'Manual da Marca'],
            ],
        ],
        [
            'text' => 'SERVIÇOS',
            'submenu' => [
                ['route' => '/obras-andamento', 'text' => 'Obras em Andamento'],
                ['route' => '/iptu-online', 'text' => 'IPTU Online'],
                ['route' => '/alvara-autodeclaratorio', 'text' => 'Alvará Autodeclaratório'],
            ],
        ],
        ['icon' => 'fas fa-search'],
    ],
])

<header x-data="{ openSearch: false }" {{ $attributes->merge(['class' => 'bg-white shadow-md relative']) }}
    @keydown.escape.window="openSearch = false; $store.mobileMenuOpen = false"
    @click.outside="$store.mobileMenuOpen = false; openSearch = false">
    <div class="px-4 py-4 mx-auto max-w-7xl sm:container">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('site.home') }}" class="flex-shrink-0" aria-label="Página inicial">
                    <img src="{{ $logo }}" alt="{{ $alt }}" class="w-auto max-h-20 md:max-h-24" loading="eager" width="auto" height="auto">

                </a>
            </div>

            {{-- Links Desktop --}}
            <nav class="hidden md:flex md:items-center md:space-x-6 lg:space-x-8" aria-label="Navegação principal">
                @foreach ($links as $index => $link)
                    @if (isset($link['icon']))
                        {{-- Ícone de busca --}}
                        @if ($link['icon'] === 'fas fa-search')
                            <div class="relative">
                                <button @click="openSearch = !openSearch"
                                    class="p-2 text-[#004348] hover:text-teal-600 transition-colors rounded-full hover:bg-gray-100"
                                    :aria-expanded="openSearch ? 'true' : 'false'"
                                    aria-label="Abrir busca">
                                    <i class="text-xl {{ $link['icon'] }}"></i>
                                </button>
                            </div>
                        @else
                            <a href="{{ $link['route'] ?? '#' }}"
                                class="p-2 text-[#004348] hover:text-teal-600 transition-colors rounded-full hover:bg-gray-100"
                                aria-label="{{ $link['text'] ?? 'Link' }}">
                                <i class="text-xl {{ $link['icon'] }}"></i>
                            </a>
                        @endif
                    @elseif(isset($link['submenu']))
                        <div x-data="{ open: false }" class="relative" @keydown.escape="open = false">
                            <button @mouseenter="open = true" @mouseleave="open = false" @click="open = !open"
                                class="flex items-center px-3 py-2 text-sm font-bold text-[#004348] hover:text-teal-600 transition-colors whitespace-nowrap rounded-md hover:bg-gray-50"
                                :aria-expanded="open ? 'true' : 'false'"
                                aria-haspopup="true"
                                aria-controls="submenu-{{ $index }}-desktop">
                                {{ $link['text'] }}
                                <i class="ml-1 text-xs fas fa-chevron-down" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-transition
                                @mouseenter="open = true" @mouseleave="open = false"
                                class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white rounded-md shadow-lg"
                                id="submenu-{{ $index }}-desktop"
                                role="menu"
                                aria-orientation="vertical">
                                @foreach ($link['submenu'] as $sublink)
                                    <a href="{{ $sublink['route'] }}"
                                        class="block px-4 py-2 text-sm text-[#004348] hover:bg-gray-100 hover:text-teal-600 transition-colors"
                                        role="menuitem">
                                        {{ $sublink['text'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $link['route'] }}"
                            class="px-3 py-2 text-sm font-bold text-[#004348] hover:text-teal-600 transition-colors whitespace-nowrap rounded-md hover:bg-gray-50">
                            {{ $link['text'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Botão Menu Mobile --}}
            <div class="flex md:hidden">
                <button @click="$store.mobileMenuOpen = !$store.mobileMenuOpen" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#004348] hover:text-teal-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500"
                    :aria-expanded="$store.mobileMenuOpen ? 'true' : 'false'"
                    aria-controls="mobile-menu">
                    <span class="sr-only">Abrir menu principal</span>
                    <i x-show="!$store.mobileMenuOpen" class="text-xl fas fa-bars" aria-hidden="true"></i>
                    <i x-show="$store.mobileMenuOpen" class="text-xl fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Form de Busca Desktop (dropdown) --}}
    <div x-cloak x-show="openSearch"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-white/95 backdrop-blur-sm"
        style="display: none;">

        <button @click="openSearch = false"
            class="absolute top-6 right-6 text-[#004348] hover:text-teal-600 transition-colors p-1 rounded-full hover:bg-gray-100"
            aria-label="Fechar busca">
            <i class="text-3xl fas fa-times-circle"></i>
        </button>

        <div class="w-full max-w-2xl px-4 md:px-0">
            <form action="{{ route('site.buscar') }}" method="GET" class="relative">
                <label for="search-input" class="sr-only">Digite sua busca</label>
                <input type="text" name="q" id="search-input" placeholder="O que você está procurando?"
                    class="w-full py-4 pl-4 pr-16 text-xl text-center text-[#004348] placeholder-gray-400 border-b-2 border-[#004348] bg-transparent focus:outline-none focus:border-teal-600"
                    x-ref="searchInput"
                    @keydown.escape="openSearch = false"
                    x-init="$watch('openSearch', value => value && $nextTick(() => $refs.searchInput.focus()))">
                <button type="submit"
                    class="absolute inset-y-0 right-0 px-4 text-[#004348] hover:text-teal-600 transition-colors"
                    aria-label="Pesquisar">
                    <i class="text-xl fas fa-search"></i>
                </button>
            </form>
            <p class="mt-4 text-sm text-center text-gray-500">Pressione Esc para fechar.</p>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="$store.mobileMenuOpen" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="bg-white shadow-lg md:hidden" id="mobile-menu"
        role="dialog" aria-modal="true" aria-label="Menu mobile">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($links as $index => $link)
                @if (isset($link['icon']))
                    {{-- Busca no Mobile --}}
                    @if ($link['icon'] === 'fas fa-search')
                        <button @click="openSearch = !openSearch"
                            class="flex items-center w-full px-4 py-3 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600 transition-colors"
                            :aria-expanded="openSearch ? 'true' : 'false'">
                            <i class="text-xl {{ $link['icon'] }} mr-3" aria-hidden="true"></i>
                            <span>Buscar</span>
                        </button>
                        {{-- Form Mobile (abre abaixo da opção) --}}
                        <div x-show="openSearch" x-transition class="px-4 py-3 bg-gray-50">
                            <form action="{{ route('site.buscar') }}" method="GET" class="flex">
                                <label for="mobile-search-input" class="sr-only">Digite sua busca</label>
                                <input type="text" name="q" id="mobile-search-input" placeholder="Digite sua busca..."
                                    class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#004348]"
                                    @keydown.escape="openSearch = false">
                                <button type="submit" class="bg-[#004348] text-white px-4 rounded-r-md hover:bg-teal-700 transition-colors"
                                    aria-label="Pesquisar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ $link['route'] ?? '#' }}"
                            class="flex items-center px-4 py-3 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600 transition-colors">
                            <i class="text-xl {{ $link['icon'] }} mr-3" aria-hidden="true"></i>
                            <span>{{ $link['text'] ?? 'Link' }}</span>
                        </a>
                    @endif
                @elseif(isset($link['submenu']))
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600 transition-colors"
                            :aria-expanded="open ? 'true' : 'false'"
                            aria-controls="submenu-{{ $index }}-mobile">
                            <span>{{ $link['text'] }}</span>
                            <i :class="{ 'fa-chevron-up': open, 'fa-chevron-down': !open }" class="ml-2 text-xs fas" aria-hidden="true"></i>
                        </button>
                        <div x-show="open" x-transition id="submenu-{{ $index }}-mobile" class="pl-6 mt-1 space-y-1 bg-gray-50">
                            @foreach ($link['submenu'] as $sublink)
                                <a href="{{ $sublink['route'] }}"
                                    class="block px-4 py-2 text-sm text-[#004348] hover:bg-gray-100 hover:text-teal-600 transition-colors">
                                    {{ $sublink['text'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $link['route'] }}"
                        class="block px-4 py-3 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600 transition-colors">
                        {{ $link['text'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</header>
