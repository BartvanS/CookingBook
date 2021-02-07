@props(['id', 'label' => null, 'default' => null])

@if($label)
    <label for="{{$id}}" class="mb-1 mt-3">{{$label}}</label>
@endif
<select name="{{$id}}"
        id="{{$id}}"
        class="px-3 py-2 rounded-lg border border-gray-300"
    {{$attributes}}>
    <option>
        {{ __('Select')  }}
    </option>
    @foreach(\App\Models\Category::all() as $category)
        <option value="{{ $category->id }}"
            {{ intval(old($id, $default)) === $category->id ? 'selected="selected"' :'' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
@error($id)
<div class="text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
