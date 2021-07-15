<x-app-layout>
    {{-- <x-slot name="header">
        <!-- se comento el codigo -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class="p-6 bg-white border-b border-gray-200">
        Bienvenido {{Auth::user()->name}}!
    </div>
</x-app-layout>
