<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recept toevoegen') }}
        </h2>
    </x-slot>

    <x-form action="{{route('recipes.store')}}" title="Nieuw recept">
        <x-input type="text"
                 id="title"
                 label="Titel"/>

        <x-text-area id="description"
                     label="Beschrijving"/>

        <x-category-select id="category"
                           label="Category"/>

        <livewire:list-input name="ingredients"
                             label="Ingredients"/>

        <livewire:list-input name="instructions"
                             label="Instructions"/>

        {{--Time--}}
        <x-input type="time"
                 id="duration"
                 label="Bereidingstijd"
                 min="0"
        />

        {{--submit--}}
        <input
            type="submit"
            class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
            value="Toevoegen"
        />
    </x-form>
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
