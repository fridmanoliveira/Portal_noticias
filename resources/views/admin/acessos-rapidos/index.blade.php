<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Acessos Rápidos') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <a href="{{ route('admin.acessos-rapidos.create') }}" class="text-blue-600 underline">Novo Acesso</a>

            <table class="w-full mt-4 border border-collapse border-gray-300 table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Título</th>
                        <th class="px-4 py-2 border">Ícone</th>
                        <th class="px-4 py-2 border">Link</th>
                        <th class="px-4 py-2 border">Ordem</th>
                        <th class="px-4 py-2 border">Ativo</th>
                        <th class="px-4 py-2 border">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acessos as $acesso)
                    <tr>
                        <td class="px-4 py-2 border">{{ $acesso->id }}</td>
                        <td class="px-4 py-2 border">{{ $acesso->titulo }}</td>
                        <td class="px-4 py-2 border">{!! $acesso->icone !!}</td>
                        <td class="px-4 py-2 border">{{ $acesso->link }}</td>
                        <td class="px-4 py-2 border">{{ $acesso->ordem }}</td>
                        <td class="px-4 py-2 border">{{ $acesso->ativo ? 'Sim' : 'Não' }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('admin.acessos-rapidos.edit', $acesso->id) }}" class="text-indigo-600 underline">Editar</a>
                            <form action="{{ route('admin.acessos-rapidos.destroy', $acesso->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 text-red-600 underline">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
