@props(['name', 'label', 'default' => null])

<label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
    {{ $label }}
</label>

<input name="{{ $name }}"
       id="{{ $name }}"
       value="{{ old($name, $default) }}"
       {{ $attributes }}
       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
