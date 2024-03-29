@props(['name', 'label' => null, 'default' => null])

@if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
    </label>
@endif

<select name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <option value="">
        {{ __('Category')  }}
    </option>
    @foreach(\App\Models\Category::orderBy('name')->get() as $category)
        <option value="{{ $category->id }}"
                @selected(intval(old($name, $default)) === $category->id)
            >
            {{ $category->name }}
        </option>
    @endforeach
</select>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
