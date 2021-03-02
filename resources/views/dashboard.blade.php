<x-app-layout>
    <x-container>
        <div class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                @foreach($categories as $category)
                    <a href="{{ route('recipes.index', ['category' => $category->id]) }}"
                       class="surface">
                        <div class="bg-gray-400 bg-cover h-32 rounded-t-lg"
                             @if($category->recipe_image) style="background-image: url('{{ Storage::url($category->recipe_image) }}')"@endif>
                        </div>
                        <div class="p-3 flex justify-between items-center">
                            <div class="font-semibold">
                                {{ $category->name }}
                            </div>
                            <div class="text-sm">
                                {{ $category->recipes_count }} {{ __('recipes') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($comments->isNotEmpty())
                <h2 class="text-xl font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate">
                    {{ __('Latest comments') }}
                </h2>

                @foreach($comments as $comment)
                    <div class="surface px-5 py-3 flex flex-col space-y-2">
                        <div class="flex justify-between">
                            <div class="flex items-center space-x-4">
                                <x-user :user="$comment->user"/>
                                <a class="text-gray-500 text-sm hover:underline"
                                   href="{{ route('recipes.show', $comment->recipe) }}">
                                    {{ __('Recipe') }}:
                                    {{ Str::limit($comment->recipe->title, 40) }}
                                </a>
                            </div>
                            <div class="text-gray-600 text-sm">
                                {{ $comment->created_at->format('j F, Y @ H:i') }}
                            </div>
                        </div>
                        <div>
                            {{ $comment->message }}
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </x-container>
</x-app-layout>
