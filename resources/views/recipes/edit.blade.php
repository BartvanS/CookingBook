<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit recipe') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form action="{{ route('recipes.update', $recipe) }}"
                title="{{ __('Edit recipe') }}">
            @method('put')

            <x-input type="text"
                     name="title"
                     label="{{ __('Title') }}"
                     :default="$recipe->title"/>

            <x-text-area name="description"
                         label="{{ __('Description') }}"
                         :default="$recipe->description"/>

            <x-category-select id="category"
                               label="{{ __('Category') }}"
                               :default="$recipe->category->id"/>

            <livewire:list-input name="ingredients"
                                 label="{{ __('Ingredients') }}"
                                 :items="$ingredients"/>

            <livewire:list-input name="instructions"
                                 label="{{ __('Instructions') }}"
                                 :items="$instructions"/>

            <x-input type="time"
                     name="duration"
                     label="{{ __('Cooking time') }}"
                     :default="\App\Services\DurationConverter::toTime($recipe->duration)"
                     min="0"/>

            <x-input type="file"
                     name="image"
                     label="{{ __('Image') }}"/>

            <input
                type="submit"
                class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
                value="{{ __('Update') }}"
            />
        </x-form>

    </x-container>

</x-app-layout>
<script>

</script>
