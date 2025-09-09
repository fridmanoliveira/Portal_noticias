<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha512-sA+e2pzXcy8XYypskDEd+bVwSEB2mKCVh+v9sGuwzdjIjg8tGQ9fGj6+uy+27xlpU4SkqS4GOsMYtRrj3r06VA=="
      crossorigin=""/>

    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    </style>

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    @stack('styles')
</head>

<body class="text-gray-900 bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside
            class="flex flex-col justify-between w-64 p-4 bg-gradient-to-b from-[#145156] to-[#0596A2] text-white shadow-lg">
            <!-- Topo com logo -->
            <div class="flex flex-col items-center space-y-6">
                <img src="{{ url('logo/logo.png') }}" alt="Logo Prefeitura" class="w-40 mb-4" />

                <!-- Navegação -->
                <nav class="w-full space-y-1">

                    <!-- Dashboard -->
                    @canany(['gerenciar usuarios', 'gerenciar conteudo', 'gerenciar ppa', 'gerenciar obras'])
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-4 py-3 space-x-3 rounded-lg transition-all
                    {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#145156] shadow-md' : 'text-white hover:bg-white/20' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A4 4 0 018 17h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    @endcanany

                    <!-- Conteúdo do Site -->
                    @can('gerenciar conteudo')
                        <div class="pt-2 mt-4 border-t border-white/20">
                            <h3 class="px-4 mb-2 text-xs font-semibold tracking-wider uppercase text-white/70">Conteúdo do
                                Site</h3>

                            <div x-data="{ open: {{ request()->routeIs('admin.banners-rotativo.*') || request()->routeIs('admin.acessos-rapidos.*') || request()->routeIs('admin.noticias.*') || request()->routeIs('admin.categorias-noticias.*') || request()->routeIs('admin.videos.*') || request()->routeIs('admin.turismo.*') ? 'true' : 'false' }} }" class="relative">
                                <button @click="open = !open"
                                    class="flex items-center justify-between w-full px-4 py-3 space-x-3 transition-all rounded-lg hover:bg-white/20">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                        <span>Conteúdo do Site</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Dropdown content -->
                                <div x-show="open" x-transition class="pl-4 mt-1 space-y-1">
                                    @can('gerenciar conteudo')
                                        <a href="{{ route('admin.banners.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.banners.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>Banners Principal</span>
                                        </a>
                                        <a href="{{ route('admin.banners-rotativo.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.banners-rotativo.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>Banners Rotativos</span>
                                        </a>
                                        <a href="{{ route('admin.acessos-rapidos.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.acessos-rapidos.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>Acessos Rápidos</span>
                                        </a>
                                        <a href="{{ route('admin.noticias.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.noticias.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>Notícias</span>
                                        </a>
                                        <a href="{{ route('admin.categorias-noticias.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.categorias-noticias.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>Categorias de Notícias</span>
                                        </a>
                                        <a href="{{ route('admin.videos.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.videos.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>História da Cidade</span>
                                        </a>
                                        <a href="{{ route('admin.turismo.index') }}"
                                            class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.turismo.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                            <span>Turismo</span>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endcan

                    <!-- PPA Participativo -->
                    @can('gerenciar ppa')
                        <div class="pt-2 mt-4 border-t border-white/20">
                            <h3 class="px-4 mb-2 text-xs font-semibold tracking-wider uppercase text-white/70">PPA
                                Participativo</h3>

                            <div x-data="{ open: {{ request()->routeIs('admin.questions.*') || request()->routeIs('admin.ppa.*') ? 'true' : 'false' }} }" class="relative">
                                <button @click="open = !open"
                                    class="flex items-center justify-between w-full px-4 py-3 space-x-3 transition-all rounded-lg hover:bg-white/20">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span>PPA Participativo</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Dropdown content -->
                                <div x-show="open" x-transition class="pl-4 mt-1 space-y-1">
                                    <a href="{{ route('admin.questions.index') }}"
                                        class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.questions.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                        <span>Questões PPA</span>
                                    </a>
                                    <a href="{{ route('admin.ppa.dashboard') }}"
                                        class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.ppa.dashboard') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                        <span>Respostas PPA</span>
                                    </a>
                                    <a href="{{ route('admin.ppa.settings') }}"
                                        class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.ppa.settings') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                        <span>Configurações PPA</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endcan

                    <!-- Obras -->
                    @can('gerenciar obras')
                        <div class="pt-2 mt-4 border-t border-white/20">
                            <h3 class="px-4 mb-2 text-xs font-semibold tracking-wider uppercase text-white/70">Obras</h3>

                            <div x-data="{ open: {{ request()->routeIs('admin.obras.*') || request()->routeIs('admin.empresa.*') || request()->routeIs('admin.fiscal.*') ? 'true' : 'false' }} }" class="relative">
                                <button @click="open = !open"
                                    class="flex items-center justify-between w-full px-4 py-3 space-x-3 transition-all rounded-lg hover:bg-white/20">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span>Obras</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Dropdown content -->
                                <div x-show="open" x-transition class="pl-4 mt-1 space-y-1">
                                    <a href="{{ route('admin.obras.index') }}"
                                        class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.obras.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                        <span>Obras</span>
                                    </a>
                                    <a href="{{ route('admin.empresas.index') }}"
                                        class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.empresas.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                        <span>Empresas</span>
                                    </a>
                                    <a href="{{ route('admin.fiscais.index') }}"
                                        class="flex items-center px-4 py-2 space-x-3 text-sm rounded-lg transition-all {{ request()->routeIs('admin.fiscais.*') ? 'bg-white text-[#145156]' : 'text-white hover:bg-white/20' }}">
                                        <span>Fiscais</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endcan

                     <!-- Dashboard -->
                    @canany(['gerenciar usuarios'])
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center px-4 py-3 space-x-3 rounded-lg transition-all
                    {{ request()->routeIs('admin.users.index') ? 'bg-white text-[#145156] shadow-md' : 'text-white hover:bg-white/20' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A4 4 0 018 17h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Usuários</span>
                        </a>
                    @endcanany
                </nav>
            </div>

            <!-- Rodapé com botão sair e logo -->
            <div class="flex flex-col items-center space-y-4">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center w-full px-6 py-2 space-x-2 font-bold text-[#145156] transition-colors bg-white rounded-lg hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Sair</span>
                    </button>
                </form>

                <img src="{{ asset('logo/soft-logo.png') }}" alt="Logo Soft"
                    class="mt-4 transition-opacity w-28 opacity-90 hover:opacity-100">
            </div>
        </aside>


        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="px-6 py-4 bg-white border-b shadow-sm">
                <h1 class="text-2xl font-semibold">{{ $header ?? 'Administração' }}</h1>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Alpine JS for dropdown functionality -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>

</html>
