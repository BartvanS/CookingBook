<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Recepten') }}
            </h2>

            <a href="{{route('recipes.create')}}"
               class="px-3 py-1 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-800 transition transition-colors duration-100">
                Nieuwe
            </a>
        </div>
    </x-slot>

    <livewire:recipes likeQuery=""/>

</x-app-layout>
