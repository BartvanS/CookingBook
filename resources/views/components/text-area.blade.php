<label for="{{$id}}" class="mb-1 mt-3">{{$label}}</label>
<textarea class="{{$class}}"
          name="{{$id}}"
          id="{{$id}}">{{ old($id) }}</textarea>
@error($id)
<div class="text-red-800 mt-1">
    {{ $message }}
</div>
@enderror
