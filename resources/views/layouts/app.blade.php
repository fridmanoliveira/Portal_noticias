<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    @stack('styles')
</head>
<body class="text-gray-900 bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
<aside class="flex flex-col justify-between w-64 p-4 bg-white shadow-lg">
    <!-- Topo com logo -->
    <div class="flex flex-col items-center space-y-4">
        <img src="{{ url('logo/logo-header.png') }}" alt="Logo Prefeitura" class="w-40 mb-8" />

        <!-- Navegação -->
        <nav class="w-full mt-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-2 space-x-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.dashboard') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 018 17h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.banners-rotativo.index') }}"
                class="block px-4 py-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.banners-rotativo.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                Banners Rotativos
            </a>

            <a href="{{ route('admin.acessos-rapidos.index') }}"
                class="block px-4 py-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.acessos-rapidos.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                Acessos Rápidos
            </a>

            <a href="{{ route('admin.noticias.index') }}"
                class="block px-4 py-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.noticias.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                Notícias
            </a>

            <a href="{{ route('admin.categorias-noticias.index') }}"
                class="block px-4 py-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.categorias-noticias.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                Categorias de Notícias
            </a>

            <a href="{{ route('admin.videos.index') }}"
                class="block px-4 py-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.videos.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                História da Cidade
            </a>

            <a href="{{ route('admin.turismo.index') }}"
                class="block px-4 py-2 rounded-md transition-colors
                    {{ request()->routeIs('admin.turismo.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                Turismo
            </a>

            <!-- Grupo PPA Participativo com dropdown -->
            <div class="relative group">
                <button class="flex items-center justify-between w-full px-4 py-2 text-gray-700 bg-[#e8e8e8] rounded-md hover:bg-[#0596A2] hover:text-white transition-colors">
                    <span>PPA Participativo</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown content -->
                <div class="absolute right-0 z-10 hidden mt-1 space-y-1 bg-white rounded-md shadow-lg left-5 group-hover:block">
                    <a href="{{ route('admin.questions.index') }}"
                        class="block px-4 py-2 rounded-md transition-colors
                            {{ request()->routeIs('admin.questions.*') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                        Questões PPA
                    </a>
                    <a href="{{ route('admin.ppa.dashboard') }}"
                        class="block px-4 py-2 rounded-md transition-colors
                            {{ request()->routeIs('admin.ppa.dashboard') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                        Respostas PPA
                    </a>
                    <a href="{{ route('admin.ppa.settings') }}"
                        class="block px-4 py-2 rounded-md transition-colors
                            {{ request()->routeIs('admin.ppa.settings') ? 'bg-[#145156] text-white' : 'text-gray-700 bg-[#e8e8e8] hover:bg-[#0596A2] hover:text-white' }}">
                        configurações PPA
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Rodapé com botão sair e logo -->
    <div class="flex flex-col items-center space-y-4">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                class="w-full px-6 py-2 font-bold text-white transition-colors bg-orange-500 rounded-md hover:bg-orange-600">
                Sair
            </button>
        </form>

        <img src="{{ asset('logo/soft-logo.png') }}" alt="Logo Soft" class="mt-4 w-28">
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

    @stack('scripts')
</body>
</html>
