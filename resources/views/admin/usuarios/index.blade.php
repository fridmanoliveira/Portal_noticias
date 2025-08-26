<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Lista de Usuários</h2>
                <p class="mt-1 text-sm text-gray-500">Gerencie os usuários e suas permissões</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-[#0596A2] rounded-lg hover:bg-[#047a85] transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Novo Usuário
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="p-4 mb-6 rounded-lg bg-green-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Card da Tabela -->
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <!-- Cabeçalho da Tabela -->
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-700">Usuários Cadastrados</h3>
                        <div class="relative">
                            <input type="text" placeholder="Buscar usuário..."
                                   class="pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2]">
                            <svg class="absolute w-5 h-5 text-gray-400 left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Tabela -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nome</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Roles</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Permissões</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        @foreach($user->roles as $role)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        @foreach($user->permissions_list as $permission)
                                            <span class="inline-block px-2 py-1 text-xs font-medium text-white bg-[#0596A2] rounded">{{ $permission }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="p-2 text-gray-500 transition-colors rounded-full hover:bg-gray-100 hover:text-yellow-600"
                                               title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-2 text-gray-500 transition-colors rounded-full hover:bg-gray-100 hover:text-red-600"
                                                        title="Excluir"
                                                        onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-4 text-lg font-medium text-gray-600">Nenhum usuário encontrado</p>
                                        <p class="mt-1 text-gray-500">Cadastre seu primeiro usuário clicando no botão "Novo Usuário"</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- <!-- Paginação -->
                @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $users->links() }}
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
</x-app-layout>
