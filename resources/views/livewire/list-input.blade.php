<div class="flex flex-col">
    <label for="{{ $name }}-input" class="mb-1 mt-3">
        {{ $label }}
    </label>

    <input type="text"
           name="{{ $name }}-input"
           id="{{ $name }}-input"
           class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300 mb-1"
           onkeydown="return event.key != 'Enter';"
           wire:model="value"
           wire:keydown.enter="add()"
           autocomplete="off"/>

    <ul class="list-decimal pl-5">
        @foreach($items as $index => $item)
            <li class="py-1">
                <div class="flex justify-between">
                    <div>
                        {{ $item }}
                    </div>
                    <div class="text-blue-900 hover:text-red-500 cursor-pointer"
                         wire:click="remove({{ $index }})">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <input type="hidden"
           name="{{ $name }}"
           value="{{ implode(PHP_EOL, $items) }}"/>

    @error($name)
    <div class="text-red-800 mt-1">
        {{ $message }}
    </div>
    @enderror
</div>
