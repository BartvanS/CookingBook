@props(['id', 'label', 'default' => null])

<label for="{{$id}}" class="mb-1 mt-3">{{$label}}</label>
<input name="{{$id}}"
       id="{{$id}}"
       value="{{ old($id, $default) }}"
       class="px-3 py-2 rounded-lg border border-gray-300"
    {{$attributes}}
/>
@error($id)
<div class="text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
