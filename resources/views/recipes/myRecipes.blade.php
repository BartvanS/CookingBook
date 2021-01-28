<x-app-layout>
    <x-slot name="header">
        my recipes
    </x-slot>
    <x-recipe-table :recipes="$recipes"/>
</x-app-layout>

