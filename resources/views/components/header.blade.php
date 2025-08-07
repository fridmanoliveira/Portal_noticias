@props([
    'logo' => asset('logo/logo-header.png'),
    'alt' => 'Prefeitura de Cristino Castro',
    'links' => [
        ['route' => '/', 'text' => 'INÍCIO'],
        [
            'text' => 'MUNICÍPIO',
            'submenu' => [
                ['route' => '/historia', 'text' => 'História'],
                ['route' => '/turismo', 'text' => 'Turismo'],
            ]
        ],
        [
            'text' => 'A PREFEITURA',
            'submenu' => [
                ['route' => '/video-monitoramento', 'text' => 'Video Monitoramento'],
                ['route' => '/ppa-participativo', 'text' => 'PPA Participativo'],
            ]
        ],
        [
            'text' => 'SERVIÇOS',
            'submenu' => [
                ['route' => '/obras', 'text' => 'Obras em Andamento'],
                ['route' => '/iptu-online', 'text' => 'IPTU Online'],
                ['route' => '/alvara-autodeclaratorio', 'text' => 'Alvará Autodeclaratório'],
            ]
        ],
        ['route' => '#', 'icon' => 'fas fa-search'],
    ]
])

<header x-data="{ mobileMenuOpen: false }"
        {{ $attributes->merge(['class' => 'bg-white shadow-md']) }}
        @click.outside="mobileMenuOpen = false">
    <div class="px-4 py-4 mx-auto max-w-7xl sm:container">
        <div class="flex items-center justify-between h-16">
            <!-- Logo e botão mobile -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('site.home') }}" class="flex-shrink-0">
                    <img src="{{ $logo }}"
                         alt="{{ $alt }}"
                         class="w-auto h-15 md:h-15"
                         loading="eager">
                </a>
            </div>

            <!-- Menu desktop (hidden em mobile) -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                @foreach($links as $link)
                    @if(isset($link['icon']))
                        <a href="{{ $link['route'] }}"
                        class="p-1 text-[#004348] hover:text-teal-600 transition-colors">
                            <i class="text-xl {{ $link['icon'] }}"></i>
                        </a>
                    @elseif(isset($link['submenu']))
                        <div x-data="{ open: false }" class="relative group">
                            <button @mouseenter="open = true" @mouseleave="open = false"
                                    class="flex items-center px-3 py-2 text-sm font-bold text-[#004348] hover:text-teal-600 transition-colors whitespace-nowrap">
                                {{ $link['text'] }}
                                <i class="ml-1 text-xs fas fa-chevron-down"></i>
                            </button>
                            <div x-show="open"
                                @mouseenter="open = true" @mouseleave="open = false"
                                x-transition
                                class="absolute left-0 z-50 w-48 mt-2 bg-white rounded-md shadow-lg">
                                @foreach($link['submenu'] as $sublink)
                                    <a href="{{ $sublink['route'] }}"
                                    class="block px-4 py-2 text-sm text-[#004348] hover:bg-gray-100 hover:text-teal-600">
                                        {{ $sublink['text'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $link['route'] }}"
                        class="px-3 py-2 text-sm font-bold text-[#004348] hover:text-teal-600 transition-colors whitespace-nowrap">
                            {{ $link['text'] }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Botão mobile (hidden em desktop) -->
            <div class="flex md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-[#004348] hover:text-teal-600 focus:outline-none"
                        aria-controls="mobile-menu"
                        aria-expanded="false">
                    <span class="sr-only">Abrir menu</span>
                    <i x-show="!mobileMenuOpen" class="text-xl fas fa-bars"></i>
                    <i x-show="mobileMenuOpen" class="text-xl fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="bg-white shadow-lg md:hidden"
         id="mobile-menu">
        <div class="hidden md:flex md:items-center md:space-x-8">
            @foreach($links as $link)
                @if(isset($link['icon']))
                    <a href="{{ $link['route'] }}"
                    class="p-1 text-[#004348] hover:text-teal-600 transition-colors">
                        <i class="text-xl {{ $link['icon'] }}"></i>
                    </a>
                @elseif(isset($link['submenu']))
                    <div x-data="{ open: false }" class="relative group">
                        <button @mouseenter="open = true" @mouseleave="open = false"
                                class="flex items-center px-3 py-2 text-sm font-bold text-[#004348] hover:text-teal-600 transition-colors whitespace-nowrap">
                            {{ $link['text'] }}
                            <i class="ml-1 text-xs fas fa-chevron-down"></i>
                        </button>
                        <div x-show="open"
                            @mouseenter="open = true" @mouseleave="open = false"
                            x-transition
                            class="absolute left-0 z-50 w-48 mt-2 bg-white rounded-md shadow-lg">
                            @foreach($link['submenu'] as $sublink)
                                <a href="{{ $sublink['route'] }}"
                                class="block px-4 py-2 text-sm text-[#004348] hover:bg-gray-100 hover:text-teal-600">
                                    {{ $sublink['text'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $link['route'] }}"
                    class="px-3 py-2 text-sm font-bold text-[#004348] hover:text-teal-600 transition-colors whitespace-nowrap">
                        {{ $link['text'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</header>
