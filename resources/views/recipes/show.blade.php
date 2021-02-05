<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="md:col-span-3 grid grid-cols-1 gap-5">
                <div class="surface relative">
                    <img alt="{{ $recipe->title }}"
                         class="w-full rounded-lg"
                         src="https://static.ah.nl/static/recepten/img_RAM_PRD142996_890x_JPG.jpg"/>
                    <div class="bg-white rounded-t-lg absolute top-0 left-0 w-full flex items-center justify-between">
                        <div class="p-5 text-xl font-bold">
                            {{ $recipe->title }}
                        </div>
                        <div class="flex px-5">
                            @can('delete', $recipe)
                                <form method="post"
                                      action="{{ route('recipes.destroy', $recipe) }}">
                                    @csrf
                                    @method('DELETE')

                                    <x-button component="button"
                                              type="submit"
                                              class="mr-3"
                                              onclick="return confirmDeleteModel()">
                                        {{ __('Delete') }}
                                    </x-button>
                                </form>
                            @endcan
                            @can('update', $recipe)
                                <x-button href="{{ route('recipes.edit', $recipe) }}">
                                    {{ __('Update') }}
                                </x-button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="surface p-4">
                    <div class="text-lg text-blue-900 font-bold">
                        {{ __('Description') }}
                    </div>
                    <div>
                        {{ $recipe->description }}
                    </div>
                </div>
                <div class="surface">
                    <div class="px-4 pt-3 pb-2 text-lg text-blue-900 font-bold">
                        {{ __('Instructions') }}
                    </div>
                    @foreach($recipe->instructions as $instruction)
                        <div class="px-4 py-2 text-md border-t border-gray-300">
                            <span class="text-blue-900 font-bold">{{ $loop->iteration }}.</span>
                            {{ $instruction->instruction }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="surface p-4">
                    <div class="text-blue-900 font-bold">
                        Author
                    </div>
                    <x-user :user="$recipe->user"/>
                    <div class="text-blue-900 font-bold mt-3">
                        Category
                    </div>
                    <div>
                        {{ $recipe->category }}
                    </div>
                    <div class="text-blue-900 font-bold mt-3">
                        Bereidingstijd
                    </div>
                    {{ \App\Services\DurationConverter::toHuman($recipe->duration) }}
                    <div class="text-blue-900 font-bold mt-3">
                        Gepubliceerd
                    </div>
                    <div>
                        {{ $recipe->created_at->format('j F, Y @ H:i') }}
                    </div>
                </div>
                <div class="surface mt-5">
                    <div class="px-4 pt-3 pb-2 text-lg text-blue-900 font-bold">
                        {{ __('Ingredients') }}
                    </div>
                    @foreach($recipe->ingredients as $ingredient)
                        <div class="px-4 py-2 text-md border-t border-gray-300">
                            {{ $ingredient->name }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @can('viewAny', \App\Models\Comment::class)
            <div class="w-full md:w-3/4">
                <livewire:comments-list :recipe="$recipe"/>
            </div>
        @endcan
    </div>

</x-app-layout>
