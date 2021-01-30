
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
                <x-input
                    type="text"
                    id="title"
                    class="px-3 py-2 rounded-lg border border-gray-300"
                    label="Titel"
                />
                <x-text-area
                    id="description"
                    class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
                    label="Beschrijving"
                />
                {{--ingredient Input field--}}
                <x-ingredients.form
                    value="{{old('ingredients')}}"
                />

                {{--Time--}}
                <div class="flex mt-3">
                    <div class="flex-grow flex-col">
                        <x-input
                            type="number"
                            id="hours"
                            class="px-3 py-2 rounded-lg border border-gray-300"
                            label="Tijd in uren"
                            min="0"
                        />
                    </div>
                    <div class="flex-grow flex-col ml-3">
                        <div class="flex-grow flex-col">
                            <x-input
                                type="number"
                                id="minutes"
                                class="px-3 py-2 rounded-lg border border-gray-300"
                                label="Tijd in minuten"
                                min="0"

                            />
                        </div>
                    </div>
                </div>

                {{--submit--}}
                <input
                    type="submit"
                    class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
                    value="Toevoegen"
                    onclick="return validateSubmit()"
                />
            </div>
        </div>
    </form>
</x-app-layout>

<script>
    let hiddenIngredientFieldEl = document.getElementById("ingredients");
    let ingredientInputEl = document.getElementById("ingredientInput");
    ingredientInputEl.addEventListener("keydown", function (event) {
        if (event.ctrlKey && event.key === "Enter") {
            //rework me or something
        } else if (event.key === "Enter") {
            event.preventDefault();
            addToIngredientsList();
        }
    });

    // let parsedIngredients = JSON.parse(hiddenIngredientFieldEl.value);
    if (hiddenIngredientFieldEl.value.length <= 0) {
        hiddenIngredientFieldEl.value = '[]';
    }
    let ingredients = JSON.parse(hiddenIngredientFieldEl.value);

    ingredients.forEach(element => addToIngredientsListHtml(element));

    function validateSubmit() {
        let confirmContinue = confirm("Wil je dit opslaan?");
        if (confirmContinue) {
            //disable to not send the data
            ingredientInputEl.setAttribute("disabled", "disabled");
        }
        return confirmContinue;
    }

    function addToIngredientsList() {
        let inputValue = ingredientInputEl.value;
        if (!inputValue || !ingredients.indexOf(inputValue)) {
            //todo: error box
            console.log("geen waarde voor ingredient")
            return;
        }
        ingredients.push(inputValue)
        ingredientInputEl.value = "";
        ingredientInputEl.focus();
        hiddenIngredientFieldEl.value = JSON.stringify(ingredients);
        addToIngredientsListHtml(inputValue);
    }

    function addToIngredientsListHtml(inputValue) {
        document.getElementById("ingredientList").innerHTML +=
            '<div class="flex" id="ingredient-' + inputValue + '">' +
            '<div class="flex-1">' + inputValue + '</div>' +
            '<button class="flex-4" type="button" onclick="removeFromIngredientsList(this)" >' +
            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor" width="20px">' +
            '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />' +
            '</svg>' +
            '</button>' +
            '</div>';
    }

    function removeFromIngredientsList(elem) {
        ingredients = ingredients.filter(item => "ingredient-" + item !== elem.parentNode.id);
        elem.parentNode.parentNode.removeChild(elem.parentNode);
        hiddenIngredientFieldEl.value = JSON.stringify(ingredients);
    }

</script>
