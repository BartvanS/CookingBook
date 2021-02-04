@props(['user'])

<div {{ $attributes->merge(['class' => 'flex items-center']) }} class="mb-3">
    <a class="flex text-sm border-2 border-transparent rounded-full transition duration-150 ease-in-out">
        <img class="h-6 w-6 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
             alt="{{ $user->name }}"/>
    </a>
    <div class="ml-1 truncate">
        {{ $user->name }}
    </div>
</div>
