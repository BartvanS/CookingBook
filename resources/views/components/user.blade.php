@props(['user'])

<a {{ $attributes->merge(['class' => 'flex items-center hover:underline hover:text-blue-600']) }}
   href="{{ route('author.show', $user) }}">
    <div class="flex text-sm border-2 border-transparent rounded-full transition duration-150 ease-in-out">
        <img class="h-6 w-6 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
             alt="{{ $user->name }}"/>
    </div>
    <div class="ml-1 truncate">
        {{ $user->name }}
    </div>
</a>
