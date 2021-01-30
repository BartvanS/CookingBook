<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col">

        <div class="flex justify-between items-center mb-5">
            <input wire:model="search"
                   type="text"
                   name="search"
                   aria-label="Zoeken"
                   placeholder="Zoek recepten..."
                   class="px-3 py-2 rounded-lg border border-gray-300 shadow">

            <a href="{{route('recipes.create')}}"
               class="px-3 py-2 rounded-lg bg-blue-600 text-white text-lg font-bold hover:bg-blue-800 transition transition-colors duration-100 shadow">
                Nieuwe
            </a>
        </div>

        <x-recipe-table :recipes="$recipes"/>
    </div>
</div>
