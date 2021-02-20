<div class="flex flex-col">
    <div class="flex justify-between items-center mb-5">
        <div class="flex space-x-4">
            <input wire:model="search"
                   type="text"
                   name="search"
                   aria-label="Zoeken"
                   placeholder="{{ __('Search') }} ..."
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
            <x-category-select name="category"
                               wire:model="category"/>
        </div>

        @can('create', \App\Models\Recipe::class)
            <x-button-primary href="{{ route('recipes.create') }}">
                <x-icons.plus class="-ml-1 mr-2 h-5 w-5"/>
                {{ __('New recipe') }}
            </x-button-primary>
        @endcan
    </div>
    @if($recipes->isEmpty())
        <div class="surface flex justify-center items-center p-5 text-lg">
            {{ __('No recipes found') }}
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($recipes as $recipe)
                <a class="surface hover:shadow-lg flex flex-col focus:ring ring-blue-600"
                   href="{{ route('recipes.show', $recipe) }}">
                    <div class="bg-gray-400 h-48 rounded-t-lg overflow-hidden bg-cover flex items-end relative"
                         style="background-image: url('{{ $recipe->thumbnail ? Storage::url($recipe->thumbnail) : ''}}')">

                        @if(!$recipe->thumbnail)
                            <svg class="h-10 w-10 absolute inset-0 m-auto text-gray-600"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        @endif
                        <div class="flex space-x-2 p-3">
                            <div
                                class="py-0.5 px-2 rounded-lg bg-white text-sm text-black shadow flex items-center">
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
                            @if($recipe->yield)
                                <div
                                    class="py-0.5 px-2 rounded-lg bg-white text-sm text-black shadow flex items-center">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $recipe->yield }}
                                </div>
                            @endif
                            <div class="py-0.5 px-2 rounded-lg bg-blue-600 text-sm text-white shadow">
                                {{ $recipe->category->name }}
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="text-black font-bold text-md">
                            {{ $recipe->title }}
                        </div>
                        @if($recipe->description)
                            <div class="truncate text-gray-600 text-sm">
                                {{ Str::limit($recipe->description) }}
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $recipes->links() }}
        </div>
    @endif
</div>
