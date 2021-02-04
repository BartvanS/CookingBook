@props(['name', 'label' => null, 'default' => ''])

@if($label)
    <label for="{{ $name }}" class="mb-1 mt-3">
        {{ $label }}
    </label>
@endif
<textarea name="{{ $name }}"
          {{ $attributes }}
          class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
          id="{{ $name }}">{{ old($name, $default) }}</textarea>
@error($name)
<div class="text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
