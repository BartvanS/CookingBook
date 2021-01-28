<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recept toevoegen') }}
        </h2>
    </x-slot>

    <form method="post" action="{{route('recipes.store')}}">
        @csrf

        <div class="bg-white rounded-lg container mx-auto max-w-md relative mt-12">

            <div class="font-bold text-xl bg-white rounded-full px-3 py-2 absolute ml-5 shadow"
                 style="margin-top: -25px">
                Nieuw recept toevoegen
            </div>

            <div class="flex flex-col p-5 pt-8">

                <label for="title" class="mb-1">Titel</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="px-3 py-2 rounded-lg border border-gray-300"
                       value="{{ old('title') }}"/>
                @error('title')
                <div class="text-red-800 mt-1">
                    {{ $message }}
                </div>
                @enderror

                <label for="description" class="mb-1 mt-3">Beschrijving</label>
                <textarea class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
                          type="text"
                          name="description"
                          id="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-red-800 mt-1">
                    {{ $message }}
                </div>
                @enderror

                <label for="ingredients" class="mb-1 mt-3">Ingredienten</label>
                <textarea class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
                          type="text"
                          name="ingredients"
                          id="ingredients"
                          value="{{old('ingredients')}}"></textarea>
                @error('ingredients')
                <div class="text-red-800 mt-1">
                    {{ $message }}
                </div>
                @enderror

                <div class="flex mt-3">
                    <div class="flex-grow flex-col">
                        <label for="hours" class="mb-1">Tijd in uren</label>
                        <input type="number"
                               name="hours"
                               id="hours"
                               value="{{old('hours')}}"
                               class="px-3 py-2 rounded-lg border border-gray-300">
                        @error('hours')
                        <div class="text-red-800 mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="flex-grow flex-col ml-3">
                        <label for="minutes" class="mb-1">Tijd in minuten</label>
                        <input type="number"
                               name="minutes"
                               id="minutes"
                               value="{{old('minutes')}}"
                               class="px-3 py-2 rounded-lg border border-gray-300">
                        @error('minutes')
                        <div class="text-red-800 mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <input type="submit"
                       class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
                       value="Toevoegen">
            </div>

        </div>
    </form>
</x-app-layout>
