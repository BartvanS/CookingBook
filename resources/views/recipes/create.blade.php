<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recept toevoegen') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col">

        <x-form action="{{ route('recipes.store') }}"
                title="{{ __('New recipe') }}">

            <x-input name="title"
                     label="{{ __('Title') }}"/>

            <x-text-area name="description"
                         label="{{ __('Description') }}"/>

            <x-category-select id="category"
                               label="{{ __('Category') }}"/>

            <livewire:list-input name="ingredients"
                                 label="{{ __('Ingredients') }}"/>

            <livewire:list-input name="instructions"
                                 label="{{ __('Instructions') }}"/>

            <x-input type="time"
                     name="duration"
                     label="{{ __('Cooking time') }}"
                     min="0"
            />

            <input
                type="submit"
                class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
                value="{{ __('Create') }}"
            />
        </x-form>
    </div>
</x-app-layout>
