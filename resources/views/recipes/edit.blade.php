<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1>Bewerk form</h1>
    <form method="post" action="{{route('recipes.update', $fields)}}">
        @method('PUT')
        <x-recipe-form :fields="$fields"/>
    </form>

    <br>
    <form method="post" action="{{route('recipes.destroy', $fields)}}">
        @csrf
        @method('DELETE')
        <input type="submit" value="YEETUS DELETUS">
    </form>
</x-app-layout>
