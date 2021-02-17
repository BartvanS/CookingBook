<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Recept toevoegen') }}
        </h2>
    </x-slot>

    <x-container>

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

            <x-input type="file"
                     name="image"
                     label="{{ __('Image') }}"/>

            <div class="">
            <input
                type="submit"
                class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
                value="{{ __('Create') }}"
            />
            </div>
        </x-form>

    </x-container>

</x-app-layout>
