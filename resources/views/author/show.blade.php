<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::user()->is($user))
                {{ __('My recipes') }}
            @else
                {{ $user->name }}
            @endif
        </h2>
    </x-slot>

    <x-container>
        <livewire:tables.recipes-table :user="$user"/>
    </x-container>

</x-app-layout>
