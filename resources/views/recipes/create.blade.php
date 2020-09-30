
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
{{--    <form method="post" action="route('recipes.store')">--}}

    <h1>Maak recept aan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{route('recipes.store')}}">
        @csrf
        <br>
        <label for="title">Titel</label><input type="text" name="title"><br><br>
        <label for="description">Beschrijving</label><input type="text" name="description"><br><br>
        <label for="hours">Tijd in uren</label><input type="number" name="hours"><br><br>
        <label for="minutes">Tijd in minuten</label><input type="number" name="minutes"><br><br>
        <input type="submit">
    </form>
</x-app-layout>
