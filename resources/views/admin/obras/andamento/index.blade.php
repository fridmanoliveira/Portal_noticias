<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                Andamentos da Obra: {{ $obra->descricao }}
            </h2>
            <a href="{{ route('admin.obras.andamentos.create', $obra->slug) }}"
               class="px-4 py-2 text-white bg-[#0596A2] rounded-lg hover:bg-[#047a85]">
                Novo Andamento
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow rounded-xl">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Descrição</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Data</th>
                            <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($andamentos as $andamento)
                            <tr>
                                <td class="px-6 py-4">{{ $andamento->descricao }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($andamento->data)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.andamento.edit', $andamento->id) }}"
                                       class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.andamento.destroy', $andamento->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Tem certeza?')"
                                                class="ml-2 text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">Nenhum andamento cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
