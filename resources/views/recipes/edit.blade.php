<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit recipe') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form-section :title="__('Update recipe')"
                        :description="__('This information will be displayed publicly so be careful what you share.')"
                        :route="route('recipes.update', $recipe)"
                        method="put">

            <div class="md:w-2/3">
                <x-input type="text"
                         name="title"
                         label="{{ __('Title') }}"
                         :default="$recipe->title"/>
            </div>

            <div>
                <x-text-area name="description"
                             label="{{ __('Description') }}"
                             :default="$recipe->description"/>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                <div>
                    <x-category-select name="category"
                                       label="{{ __('Category') }}"
                                       :default="$recipe->category->id"/>
                </div>
                <div>
                    <x-input type="time"
                             name="duration"
                             label="{{ __('Cooking time') }}"
                             :default="\App\Services\DurationConverter::toTime($recipe->duration)"
                             min="0"/>
                </div>
                <div>
                    <x-input type="number"
                             name="yield"
                             label="{{ __('Number of servings') }}"
                             :default="$recipe->yield"/>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <x-input-list label="{{ __('Ingredients') }}"
                                  name="ingredients"
                                  default="{{ $ingredients }}"/>
                </div>

                <div>
                    <x-input-list label="{{ __('Instructions') }}"
                                  name="instructions"
                                  default="{{ $instructions }}"/>
                </div>
            </div>

            <div>
                <x-file-input name="image"
                              label="{{ __('Image') }}"/>
            </div>

            <x-slot name="actions">
                <x-button href="{{ route('recipes.show', $recipe) }}">
                    {{ __('Cancel') }}
                </x-button>
                <x-button-primary component="button" type="submit">
                    {{ __('Update') }}
                </x-button-primary>
            </x-slot>
        </x-form-section>

        @can('delete', $recipe)
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <x-form-section :title="__('Delete recipe')"
                            :route="route('recipes.destroy', $recipe)"
                            method="delete">

                <div>
                    <div class="md:w-2/3">
                        {{ __('Do you want to delete the recipe?') }}
                    </div>
                </div>

                <div>
                    <x-button-danger component="button" type="submit">
                        {{ __('Delete') }}
                    </x-button-danger>
                </div>
            </x-form-section>
        @endcan

    </x-container>

</x-app-layout>
<script>

</script>
