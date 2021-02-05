<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit recipe') }}
        </h2>
    </x-slot>

    <x-form action="{{ route('recipes.update', $recipe) }}"
            title="Edit recipe">
        @method('put')

        <x-input type="text"
                 id="title"
                 label="Titel"
                 :default="$recipe->title"/>

        <x-text-area name="description"
                     label="Beschrijving"
                     :default="$recipe->description"/>

        <x-category-select id="category"
                           label="Category"
                           :default="$recipe->category"/>

        <livewire:list-input name="ingredients"
                             label="Ingredienten"
                             :items="$ingredients"/>

        <livewire:list-input name="instructions"
                             label="Instructions"
                             :items="$instructions"/>

        {{--Time--}}
        <x-input type="time"
                 id="duration"
                 label="Bereidingstijd"
                 :default="\App\Services\DurationConverter::toTime($recipe->duration)"
                 min="0"/>

        {{--submit--}}
        <input
            type="submit"
            class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
            value="Bijwerken"
        />
    </x-form>
</x-app-layout>
<script>

</script>
