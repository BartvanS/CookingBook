<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1>Maak recept aan</h1>
    <form method="post" action="{{route('recipes.store')}}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <br>
        <label for="title">Titel</label><input type="text" name="title" ><br><br>
            <label for="description">Beschrijving</label><textarea type="text" name="description" ></textarea><br><br>
        <label for="hours">Tijd in uren</label><input type="number" name="hours" ><br><br>
        <label for="minutes">Tijd in minuten</label><input type="number" name="minutes"><br><br>
        <input type="submit">
    </form>
</x-app-layout>
