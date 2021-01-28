    <label for="{{$id}}" class="mb-1">{{$label}}</label>
    <input type="{{$type}}"
           name="{{$id}}"
           id="{{$id}}"
           class="{{$class}}"
           value="{{ old($id) }}"/>
    @error($id)
    <div class="text-red-800 mt-1">
        {{ $message }}
    </div>
    @enderror
