<div class="flex flex-col">
    <div class="flex flex-col md:flex-row gap-6">
        <div class="flex flex-col justify-between md:justify-start gap-4 mb-5 md:mb-0 min-w-[15rem]">
            <div class="flex flex-col gap-2">
                <input wire:model="search"
                       type="text"
                       name="search"
                       aria-label="{{ __('Search') }}"
                       placeholder="{{ __('Search') }} ..."
                       class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>

                <x-category-select name="category"
                                   wire:model="category"/>

                <x-tag-select name="tag"
                              wire:model="tag"/>
            </div>

            <div class="flex gap-2 items-center">
                <x-button-secondary class="cursor-pointer hidden md:block flex-grow-0" wire:click="$toggle('list')">
                    @if($list)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    @endif
                </x-button-secondary>

                @can('create', \App\Models\Recipe::class)
                    <x-button-primary href="{{ route('recipes.create') }}" class="flex-grow">
                        <x-icons.plus class="-ml-1 mr-2 h-5 w-5"/>
                        {{ __('New recipe') }}
                    </x-button-primary>
                @endcan
            </div>
        </div>
        @if($recipes->isEmpty())
            <div class="surface flex justify-center items-center p-5 text-lg flex-grow">
                {{ __('No recipes found') }}
            </div>
        @else
            @if($list)
                <div class="flex flex-col flex-grow gap-5">
                    @foreach($recipes as $recipe)
                        <a class="surface hover:shadow-lg flex focus:ring ring-blue-600"
                           href="{{ route('recipes.show', $recipe) }}">
                            <div class="aspect-video h-full relative bg-gray-300 rounded-l-lg bg-cover"
                                 style="background-image: url('{{ $recipe->thumbnail ? Storage::disk('recipes')->url($recipe->thumbnail) : ''}}')">
                                @if(!$recipe->thumbnail)
                                    <svg class="h-10 w-10 absolute inset-0 m-auto text-gray-600"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex flex-col flex-grow">
                                <div class="p-5 flex flex-col gap-2">
                                    <div class="text-black font-bold text-md">
                                        {{ $recipe->title }}
                                    </div>
                                    @if($recipe->description)
                                        <div class="truncate text-gray-600 text-sm">
                                            {{ Str::limit($recipe->description, $list ? 100 : 100) }}
                                        </div>
                                    @endif
                                    <div class="flex space-x-2">
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
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
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
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($recipes as $recipe)
                        <a class="surface hover:shadow-lg flex flex-col focus:ring ring-blue-600"
                           href="{{ route('recipes.show', $recipe) }}">
                            <div class="bg-gray-400 aspect-video rounded-t-lg overflow-hidden bg-cover flex items-end relative"
                                 style="background-image: url('{{ $recipe->thumbnail ? Storage::disk('recipes')->url($recipe->thumbnail) : ''}}')">

                                @if(!$recipe->thumbnail)
                                    <svg class="h-10 w-10 absolute inset-0 m-auto text-gray-600"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                                <div class="flex gap-2 p-3 flex-wrap">
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
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
    </div>
    <div class="mt-5">
        {{ $recipes->links() }}
    </div>
    @endif
</div>
