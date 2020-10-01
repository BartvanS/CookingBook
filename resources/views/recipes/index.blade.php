<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="{{route('recipes.create')}}">creeer</a>
    </x-slot>


    <livewire:recipes />

</x-app-layout>
