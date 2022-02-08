<x-app-layout :title="__('Search')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
    </x-slot>

    <x-container>
        <livewire:tables.recipes-table/>
    </x-container>

</x-app-layout>
