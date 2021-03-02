@props(['name', 'label'])

<label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
    {{ $label }}
</label>

<div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
    <div class="space-y-1 text-center">
        <div class="flex text-sm text-gray-600">
            <label for="{{ $name }}"
                   class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <span>{{ __('Upload a file') }}</span>
                <input id="{{ $name }}"
                       name="{{ $name }}"
                       type="file"
                       class="sr-only">
            </label>
            <p class="pl-1">{{ __('or drag and drop') }}</p>
        </div>
        <p class="text-xs text-gray-500">
            PNG or JPG up to 10MB
        </p>
    </div>
</div>

@error($name)
<div class="text-sm text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
