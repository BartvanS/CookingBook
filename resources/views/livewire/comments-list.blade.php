<div>
    @can('create', \App\Models\Comment::class)
        <div class="surface p-5 mt-5">
            <div class="text-blue-900 font-bold text-lg">
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
            <div class="surface px-5 py-3 text-blue-900 font-bold text-lg">
                {{ __('Comments') }}
            </div>
            @foreach($comments as $comment)
                <div class="surface p-5">
                    <div class="flex items-center justify-between">
                        <div class="mr-2">
                            <x-user :user="$comment->user"/>
                        </div>
                        <div class="text-gray-600 text-sm">
                            {{ $comment->created_at->format('j F, Y @ H:i') }}
                        </div>
                    </div>
                    <div class="mt-2">
                        {!! nl2br(e($comment->message)) !!}
                    </div>
                </div>
            @endforeach
            {{ $comments->links() }}
        </div>
    @endif
</div>
