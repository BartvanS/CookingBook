@props(['id', 'label', 'default' => null])

<label for="{{$id}}" class="mb-1 mt-3">{{$label}}</label>
<select name="{{$id}}"
        id="{{$id}}"
        class="px-3 py-2 rounded-lg border border-gray-300"
    {{$attributes}}>
    <option>
        {{ __('Select')  }}
    </option>
    @foreach(\App\Dto\RecipeCategory::all() as $category)
        <option value="{{ $category }}"
            {{ old($id, $default) === $category ? 'selected="selected"' :'' }}>
            {{ $category }}
        </option>
    @endforeach
</select>
@error($id)
<div class="text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
