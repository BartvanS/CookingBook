<div>
    @can('create', \App\Models\Comment::class)
        <div class="surface p-5 mt-5">
            <div class="font-bold text-lg">
                {{ __('Add comment') }}
            </div>
            <form wire:submit.prevent="submit"
                  class="flex flex-col">
                <x-text-area name="message"
                             aria-label="Message"
                             wire:model.lazy="message"/>

                <div class="flex justify-end mt-2">
                    <x-button component="button"
                              type="submit">
                        {{ __('Post') }}
                    </x-button>
                </div>
            </form>
        </div>
    @endauth

    @if($comments->isNotEmpty())
        <div class="grid grid-cols-1 gap-5 mt-5">
            <div class="surface">
                <div class="px-4 py-5 border-b border-gray-200 dark:border-gray-700 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Comments') }}
                    </h3>
                </div>
            @foreach($comments as $comment)
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="px-4 py-5 sm:px-6">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ $comment->user->profile_photo_url }}"
                                     alt="{{ $comment->user->name }}">
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    <a href="#" class="hover:underline">{{ $comment->user->name }}</a>
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <a href="#"
                                       class="hover:underline">{{ $comment->created_at->format('j F, Y \o\m H:i') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-2">
                        {!! nl2br(e($comment->message)) !!}
                    </div>
                </div>
            @endforeach
            </div>
            {{ $comments->links() }}
        </div>
    @endif
</div>
