@props(['name', 'label' => null, 'default' => null])

@if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
@endif

<tag-select id="{{ $name }}"
            name="{{ $name }}"
            :options="{{ json_encode(\App\Models\Tag::get()->pluck('name')->toArray()) }}"/>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
