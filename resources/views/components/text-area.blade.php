@props(['id', 'label', 'default' => ''])

<label for="{{$id}}" class="mb-1 mt-3">
    {{$label}}
</label>
<textarea name="{{$id}}"
          class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
          id="{{$id}}">{{ old($id, $default) }}</textarea>
@error($id)
<div class="text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
