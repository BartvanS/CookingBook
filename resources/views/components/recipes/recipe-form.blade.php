@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
<br>
<label for="title">Titel</label><input type="text" name="title" value="{{$fields->title}}"><br><br>
<label for="description">Beschrijving</label><input type="text" name="description" value="{{$fields->description}}"><br><br>
<label for="hours">Tijd in uren</label><input type="number" name="hours" value="{{$fields->hours}}"><br><br>
<label for="minutes">Tijd in minuten</label><input type="number" name="minutes" value="{{$fields->minutes}}"><br><br>
<input type="submit">
