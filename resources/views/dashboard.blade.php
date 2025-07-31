<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Painel da Prefeitura') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">

            {{-- Cartões de Estatísticas --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="p-6 text-center bg-white rounded-lg shadow">
                    <p class="text-gray-500">Notícias Publicadas</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalNoticias }}</p>
                </div>
                <div class="p-6 text-center bg-white rounded-lg shadow">
                    <p class="text-gray-500">Acessos Rápidos</p>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalAcessosRapidos }}</p>
                </div>
                <div class="p-6 text-center bg-white rounded-lg shadow">
                    <p class="text-gray-500">Categorias de Notícias</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $totalCategorias }}</p>
                </div>
            </div>

            {{-- Ações rápidas --}}
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Ações Rápidas</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.noticias.create') }}"
                        class="px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">
                        Nova Notícia
                    </a>
                    <a href="{{ route('admin.noticias.index') }}"
                        class="px-4 py-2 text-white transition bg-gray-800 rounded hover:bg-gray-900">
                        Gerenciar Notícias
                    </a>
                    <a href="{{ route('admin.banners.index') }}"
                        class="px-4 py-2 text-white transition bg-indigo-600 rounded hover:bg-indigo-700">
                        Gerenciar Banners
                    </a>
                    <a href="{{ route('admin.banners-rotativo.index') }}"
                        class="px-4 py-2 text-white transition bg-indigo-600 rounded hover:bg-indigo-700">
                        Gerenciar Banners
                    </a>
                </div>
            </div>

            {{-- Últimas notícias --}}
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Últimas Notícias</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach ($ultimasNoticias as $noticia)
                        <li class="py-3">
                            <a href="#" class="text-blue-600 hover:underline">
                                {{ $noticia->titulo }}
                            </a>
                            <p class="text-sm text-gray-500">Publicado em {{ $noticia->created_at->format('d/m/Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
