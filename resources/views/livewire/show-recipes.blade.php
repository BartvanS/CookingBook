<div class="container mx-auto my-6">
    <div class="flex flex-col">

        <div class="flex justify-between items-center mb-5">
            <input wire:model="search"
                   type="text"
                   name="search"
                   aria-label="Zoeken"
                   placeholder="Zoek recepten..."
                   class="px-3 py-2 rounded-lg border border-gray-300">

            <a href="{{route('recipes.create')}}"
               class="px-3 py-2 rounded-lg bg-blue-600 text-white text-lg font-bold hover:bg-blue-800 transition transition-colors duration-100">
                Nieuwe
            </a>
        </div>

        <x-recipe-table :recipes="$recipes"/>
    </div>
</div>
