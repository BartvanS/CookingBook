<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
    </x-slot>

    <x-container>
        <livewire:recipes-table/>
    </x-container>

</x-app-layout>
