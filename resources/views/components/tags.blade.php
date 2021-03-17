@props(['name', 'label' => null, 'default' => null])

@if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
@endif

<div>
    <tag-select id="{{ $name }}"
                name="{{ $name }}"
                value="{{ old($name, $default) }}"
                :options="{{ json_encode(\App\Models\Tag::get()->pluck('name')->toArray()) }}"/>
</div>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
