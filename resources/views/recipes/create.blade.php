<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New recipe') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form-section :title="__('Create recipe')"
                        :description="__('This information will be displayed publicly so be careful what you share.')"
                        :route="route('recipes.store')">
            <div>
                <div class="md:w-2/3">
                    <x-input name="title"
                             type="text"
                             label="{{ __('Title') }}"/>
                </div>
            </div>

            <div>
                <x-text-area name="description"
                             label="{{ __('Description') }}"/>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                <div>
                    <x-category-select name="category"
                                       label="{{ __('Category') }}"/>
                </div>
                <div>
                    <x-input type="time"
                             name="duration"
                             label="{{ __('Cooking time') }}"
                             min="0"/>
                </div>
                <div>
                    <x-input type="number"
                             name="yield"
                             label="{{ __('Number of servings') }}"/>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <livewire:list-input name="ingredients"
                                     label="{{ __('Ingredients') }}"/>

                <livewire:list-input name="instructions"
                                     label="{{ __('Instructions') }}"/>
            </div>

            <div>
                <x-file-input name="image"
                              label="{{ __('Image') }}"/>
            </div>

            <x-slot name="actions">
                <x-button-primary component="button" type="submit">
                    {{ __('Create') }}
                </x-button-primary>
            </x-slot>
        </x-form-section>

    </x-container>

</x-app-layout>
