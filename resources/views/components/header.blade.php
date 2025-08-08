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

<header x-data
        {{ $attributes->merge(['class' => 'bg-white shadow-md']) }}
        @click.outside="$store.mobileMenuOpen = false"> {{-- Adicionado aqui também para fechar ao clicar fora --}}
    <div class="px-4 py-4 mx-auto max-w-7xl sm:container">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('site.home') }}" class="flex-shrink-0">
                    <img src="{{ $logo }}"
                            alt="{{ $alt }}"
                            class="w-auto h-15 md:h-15"
                            loading="eager">
                </a>
            </div>

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

            <div class="flex md:hidden">
                <button @click="$store.mobileMenuOpen = !$store.mobileMenuOpen"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-[#004348] hover:text-teal-600 focus:outline-none"
                        aria-controls="mobile-menu"
                        aria-expanded="false">
                    <span class="sr-only">Abrir menu</span>
                    <i x-show="!$store.mobileMenuOpen" class="text-xl fas fa-bars"></i>
                    <i x-show="$store.mobileMenuOpen" class="text-xl fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="$store.mobileMenuOpen"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="bg-white shadow-lg md:hidden"
         id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1"> {{-- Removido o hidden md:flex md:items-center md:space-x-8 daqui, pois é o conteúdo do mobile --}}
            @foreach($links as $link)
                @if(isset($link['icon']))
                    <a href="{{ $link['route'] }}"
                    class="block px-4 py-2 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600">
                        <i class="text-xl {{ $link['icon'] }}"></i>
                    </a>
                @elseif(isset($link['submenu']))
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="flex items-center justify-between w-full px-4 py-2 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600">
                            {{ $link['text'] }}
                            <i :class="{'fa-chevron-up': open, 'fa-chevron-down': !open}" class="ml-2 text-xs fas"></i>
                        </button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
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
                    class="block px-4 py-2 text-base font-medium text-[#004348] hover:bg-gray-50 hover:text-teal-600">
                        {{ $link['text'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</header>
