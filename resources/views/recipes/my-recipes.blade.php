<x-app-layout>
    <x-slot name="header">
        Mijn recepten
    </x-slot>

    <livewire:recipes :user="auth()->user()"/>
</x-app-layout>
