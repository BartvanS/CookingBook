<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="grid grid-cols-4 gap-3">
            <a class="surface rounded-lg shadow-lg p-5 text-black font-bold text-md" href="{{ route('recipes.index') }}">
                {{ $recipes }} {{ __('Recipes') }}
            </a>
            <a class="surface rounded-lg shadow-lg p-5 text-black font-bold text-md" href="{{ route('users.index') }}">
                {{ $users }} {{ __('Users') }}
            </a>
            <a class="surface rounded-lg shadow-lg p-5 text-black font-bold text-md" href="{{ route('categories.index') }}">
                {{ $categories }} {{ __('Categories') }}
            </a>
            <div class="surface rounded-lg shadow-lg p-5 text-black font-bold text-md">
                {{ $tags }} {{ __('Tags') }}
            </div>
        </div>
    </x-container>
</x-app-layout>
