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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
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
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <livewire:list-input name="ingredients"
                                     label="{{ __('Ingredients') }}"
                                     :items="$ingredients"/>

                <livewire:list-input name="instructions"
                                     label="{{ __('Instructions') }}"
                                     :items="$instructions"/>
            </div>

            <div>
                <x-file-input name="image"
                              label="{{ __('Image') }}"/>
            </div>

            <x-slot name="actions">
                <x-button-primary component="button" type="submit">
                    {{ __('Update') }}
                </x-button-primary>
            </x-slot>
        </x-form-section>

    </x-container>

</x-app-layout>
<script>

</script>
