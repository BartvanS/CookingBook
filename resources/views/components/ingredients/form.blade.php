{{--ingredient Input field--}}
{{--IMPORTANT!!!! for this to work you need to make sure editForm.js is loaded in!--}}
<div class="flex flex-col">
    <x-input
        type="text"
        label="Ingredient"
        id="ingredientInput"
        class="px-3 py-2 rounded-lg border border-gray-300-1"
        placeholder=""
        onchange=""
    />
    <button type="button" onclick="addToIngredientsList()" class="flex-5">Voeg toe</button>
</div>
<div id="ingredientList" class="flex-grow"></div>
{{-- old('ingredients') for create, $ingredients for edit--}}
<input type="hidden" id="ingredients" name="ingredients" value="{{$value}}">
