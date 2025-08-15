<x-site-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">PPA Participativo</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <div class="p-4 text-center bg-yellow-100 rounded-lg">
                    <h3 class="text-xl font-bold text-yellow-800">Período Encerrado</h3>
                    <p class="mt-2 text-yellow-700">{{ $message }}</p>
                </div>

                @if($settings && $settings->end_date)
                    <div class="mt-4 text-center text-gray-600">
                        O período de participação terminou em: {{ $settings->end_date->format('d/m/Y H:i') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-site-layout>
