<x-guest-layout >
    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus
                autocomplete="username"
                class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-[#0596A2] focus:border-[#0596A2]"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div>
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-[#0596A2] focus:border-[#0596A2]"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Lembrar -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox"
                   class="rounded border-gray-300 text-[#0596A2] shadow-sm focus:ring-[#0596A2]"
                   name="remember">
            <label for="remember_me" class="text-sm text-gray-600 ms-2">
                {{ __('Lembrar de mim') }}
            </label>
        </div>

        <!-- Botão Login -->
        <div>
            <x-primary-button class="w-full justify-center bg-[#0596A2] hover:bg-[#047a85] text-white py-2 rounded-lg">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
