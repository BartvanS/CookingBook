@props(['name', 'label', 'default' => null])

<label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
    {{ $label }}
</label>

<div>
    <input-list label="{{ $label }}"
                name="{{ $name }}"
                value="{{ old($name, $default) }}"/>
</div>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
