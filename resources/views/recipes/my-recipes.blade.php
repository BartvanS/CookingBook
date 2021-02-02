<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mijn recepten
        </h2>
    </x-slot>

    <livewire:recipes-table :user="auth()->user()"/>
</x-app-layout>
