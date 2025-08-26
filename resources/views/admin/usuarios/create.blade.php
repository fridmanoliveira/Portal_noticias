<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ isset($user) ? 'Editar Usuário' : 'Cadastrar Novo Usuário' }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ isset($user) ? 'Edite as informações do usuário' : 'Adicione um novo usuário ao sistema' }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" class="space-y-6">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif

                        @if($errors->any())
                            <div class="p-4 mb-6 rounded-lg bg-red-50">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="ml-3 text-sm font-medium text-red-800">
                                        Por favor, corrija os erros abaixo para continuar
                                    </p>
                                </div>
                                <ul class="mt-2 ml-5 text-sm text-red-700 list-disc">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Dados do Usuário -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Nome -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400 @error('name') border-red-500 @enderror">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400 @error('email') border-red-500 @enderror">
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Senha -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">{{ isset($user) ? 'Nova Senha' : 'Senha' }} {{ isset($user) ? '' : '*' }}</label>
                                <div class="mt-1">
                                    <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }}
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400 @error('password') border-red-500 @enderror">
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirmar Senha -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ isset($user) ? 'Confirmar Nova Senha' : 'Confirmar Senha' }} {{ isset($user) ? '' : '*' }}</label>
                                <div class="mt-1">
                                    <input type="password" name="password_confirmation" id="password_confirmation" {{ isset($user) ? '' : 'required' }}
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0596A2] focus:border-[#0596A2] placeholder-gray-400 @error('password_confirmation') border-red-500 @enderror">
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Roles e Permissões -->
                        <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                            <!-- Roles -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Roles</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($roles as $role)
                                        <label class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm cursor-pointer hover:bg-gray-50">
                                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="mr-2"
                                                {{ (isset($user) && $user->roles->contains($role->id)) || (is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'checked' : '' }}>
                                            <span class="text-sm text-gray-700">{{ $role->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Permissões -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Permissões</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($permissions as $permission)
                                        <label class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm cursor-pointer hover:bg-gray-50">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="mr-2"
                                                {{ (isset($user) && $user->permissions->contains($permission->id)) || (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) ? 'checked' : '' }}>
                                            <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Ações do Formulário -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200">
                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-[#0596A2] border border-transparent rounded-lg shadow-sm hover:bg-[#047a85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0596A2]">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                {{ isset($user) ? 'Atualizar Usuário' : 'Cadastrar Usuário' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
