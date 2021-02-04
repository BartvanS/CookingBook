<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col">

        <div class="flex justify-between items-center mb-5">
            <input wire:model="search"
                   type="text"
                   name="search"
                   aria-label="Zoeken"
                   placeholder="Zoek recepten..."
                   autofocus
                   class="px-3 py-2 rounded-lg border border-gray-300 shadow">

            @can('create', \App\Models\Recipe::class)
                <x-button href="{{route('recipes.create')}}">
                    Nieuw recept
                </x-button>
            @endcan
        </div>
        @if($recipes->isEmpty())
            <div class="flex justify-center items-center bg-white p-5 text-lg rounded-lg shadow-lg">
                Geen recepten gevonden
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($recipes as $recipe)
                    <a class="bg-white rounded-lg shadow-md hover:shadow-lg flex flex-col focus:ring ring-blue-600"
                       href="{{ route('recipes.show', $recipe) }}">
                        <div class="bg-gray-400 h-48 rounded-t-lg overflow-hidden bg-cover p-5 flex items-end"
                             style="background-image: url('https://static.ah.nl/static/recepten/img_RAM_PRD142996_890x_JPG.jpg')">
                            <div
                                class="mr-2 py-0.5 px-2 rounded-lg bg-white text-sm text-black shadow flex items-center">
                                <svg class="w-4 h-4 mr-1"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ \App\Services\DurationConverter::toHuman($recipe->duration) }}
                            </div>
                            <div class="py-0.5 px-2 rounded-lg bg-blue-600 text-sm text-white shadow">
                                {{ $recipe->category }}
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-black font-bold text-md">
                                {{ $recipe->title }}
                            </div>
                            <div class="truncate text-gray-600 text-sm">
                                {{ Str::limit($recipe->description) }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
</div>
