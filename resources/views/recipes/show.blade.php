<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipe') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-2">
            <a class="hover:underline flex items-center"
               href="{{ route('recipes.index') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('overview') }}
            </a>
        </div>
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
                            @can('update', $recipe)
                                <x-button href="{{ route('recipes.edit', $recipe) }}">
                                    {{ __('Update') }}
                                </x-button>
                            @endcan
                            @can('delete', $recipe)
                                <form method="post"
                                      action="{{ route('recipes.destroy', $recipe) }}">
                                    @csrf
                                    @method('DELETE')

                                    <x-button component="button"
                                              type="submit"
                                              class="ml-3"
                                              bg="bg-red-600"
                                              onclick="return confirmDeleteModel()">
                                        {{ __('Delete') }}
                                    </x-button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    @if($recipe->description)
                        <div class="surface p-4 w-full md:mr-5 md:w-1/2">
                            <div class="text-lg text-blue-900 font-bold">
                                {{ __('Description') }}
                            </div>
                            <div>
                                {!! nl2br(e($recipe->description)) !!}
                            </div>
                        </div>
                    @endif
                    <div class="surface w-full mt-5 md:mt-0 {{ $recipe->description ? 'md:w-1/2': '' }}">
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

                <div class="surface">
                    <div class="px-4 pt-3 pb-2 text-lg text-blue-900 font-bold">
                        {{ __('Instructions') }}
                    </div>
                    @foreach($recipe->instructions as $instruction)
                        <div class="p-4 text-md border-t border-gray-300">
                            <span class="font-bold">{{ $loop->iteration }}.</span>
                            {{ $instruction->instruction }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="surface p-4">
                    <div class="text-blue-900 font-bold">
                        {{ __('Author') }}
                    </div>
                    <x-user :user="$recipe->user"/>
                    <div class="text-blue-900 font-bold mt-3">
                        {{ __('Category') }}
                    </div>
                    <div>
                        {{ $recipe->category }}
                    </div>
                    <div class="text-blue-900 font-bold mt-3">
                        {{ __('Cooking time') }}
                    </div>
                    {{ \App\Services\DurationConverter::toHuman($recipe->duration) }}
                    <div class="text-blue-900 font-bold mt-3">
                        {{ __('Published at') }}
                    </div>
                    <div>
                        {{ $recipe->created_at->format('j F, Y @ H:i') }}
                    </div>
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
