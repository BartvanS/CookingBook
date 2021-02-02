<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $recipe->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-end mb-3">
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

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="md:col-span-3">
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-lg text-blue-900 font-bold">
                        {{ __('Bereidingswijze') }}
                    </div>
                    <div>
                        {{ $recipe->description }}
                    </div>
                </div>
                <div class="bg-white rounded-lg mt-5">
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
            <div>
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-blue-900 font-bold">
                        Author
                    </div>
                    <x-user :user="$recipe->user"/>
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
            </div>
        </div>
    </div>

</x-app-layout>
