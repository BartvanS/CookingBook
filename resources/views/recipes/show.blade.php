<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipe') }}
        </h2>
    </x-slot>

    <x-container>

        {{-- Heading --}}
        <div class="lg:flex lg:items-center lg:justify-between mb-5">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $recipe->title }}
                </h2>
                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                  clip-rule="evenodd"/>
                        </svg>
                        {{ \App\Services\DurationConverter::toHuman($recipe->duration) }}
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                        {{ $recipe->category->name }}
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                  clip-rule="evenodd"/>
                        </svg>
                        {{ $recipe->created_at->formatLocalized('%e %B, %Y') }}
                    </div>
                </div>
            </div>

            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                @can('update', $recipe)
                    <x-button href="{{ route('recipes.edit', $recipe) }}">
                        <x-icons.pencil class="-ml-1 mr-2 h-5 w-5 text-gray-500"/>
                        {{ __('Edit') }}
                    </x-button>
                @endcan
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="md:col-span-3 grid grid-cols-1 gap-5">

                @if($recipe->image)
                    <img alt="{{ $recipe->title }}"
                         class="surface w-full"
                         src="{{ Storage::url($recipe->image) }}"/>
                @endif

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
                            <div class="px-4 py-2 text-md border-t border-gray-200">
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
                        <div class="p-4 text-md border-t border-gray-200">
                            <span class="font-bold">{{ $loop->iteration }}.</span>
                            {{ $instruction->instruction }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="surface mb-5">
                    <dl>
                        <div class="px-4 py-5">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Author') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="{{ route('author.show', $recipe->user) }}"
                                   class="hover:underline">
                                    {{ $recipe->user->name }}
                                </a>
                            </dd>
                        </div>

                        <div class="px-4 py-5 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Category') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $recipe->category->name }}
                            </dd>
                        </div>

                        <div class="px-4 py-5 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Cooking time') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ \App\Services\DurationConverter::toHuman($recipe->duration) }}
                            </dd>
                        </div>

                        @if($recipe->yield)
                            <div class="px-4 py-5 border-t border-gray-200">
                                <dt class="text-sm font-medium text-gray-500">
                                    {{ __('Number of servings') }}
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $recipe->yield }}
                                </dd>
                            </div>
                        @endif

                        <div class="px-4 py-5 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Published at') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $recipe->created_at->format('j F, Y @ H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        @can('viewAny', \App\Models\Comment::class)
            <div class="w-full md:w-3/4">
                <livewire:comments-list :recipe="$recipe"/>
            </div>
        @endcan
    </x-container>

</x-app-layout>
