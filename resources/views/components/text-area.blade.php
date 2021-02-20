@props(['name', 'label' => null, 'default' => ''])

@if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
@endif

<div class="mt-1">
    <textarea name="{{ $name }}"
              {{ $attributes }}
              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
              id="{{ $name }}">{{ old($name, $default) }}</textarea>
</div>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
