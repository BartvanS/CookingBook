<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $recipe->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @can('update', $recipe)
            <div class="flex justify-end mb-3">
                <x-button href="{{ route('recipes.edit', $recipe) }}">
                    Bewerken
                </x-button>
            </div>
        @endcan

        <div class="bg-white p-4 rounded-lg">
            <div class="flex items-center mb-3">
                <a class="flex text-sm border-2 border-transparent rounded-full transition duration-150 ease-in-out">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $recipe->user->profile_photo_url }}"
                         alt="{{ $recipe->user->name }}"/>
                </a>
                <div class="ml-2">
                    {{ $recipe->user->name }}
                </div>
            </div>
            <div>
                <div class="text-bold text-blue-900 text-lg mb-1">
                    Bereidingswijze
                </div>
                {{ $recipe->description }}
            </div>
        </div>
    </div>

</x-app-layout>
